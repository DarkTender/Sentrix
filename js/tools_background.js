/**
 * TOOLBLUEPRINT — Blueprint / circuit HUD background (for tools pages)
 * Requirements in HTML:
 *   <canvas id="neural-canvas"></canvas>
 *
 * Style:
 * - technical schematic lines + ports
 * - subtle scanning pulses
 * - readable under UI/cards
 */
 (() => {
    const canvas = document.getElementById("neural-canvas");
    if (!canvas) return;
  
    const ctx = canvas.getContext("2d", { alpha: true });
  
    const reduceMotion =
      window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;
  
    const CONFIG = {
      bg: "rgba(2,6,23,1)",
  
      cyan: "56,189,248",
      purple: "168,85,247",
  
      // readability/contrast
      tintAlpha: 0.10,
      vignetteAlpha: 0.58,
  
      // trail/fade
      fade: 0.12,
  
      // circuit look
      gridStep: 44,
      lineAlpha: 0.16,
      majorAlpha: 0.24,
      lineWidth: 1,
  
      // nodes/ports
      portAlpha: 0.28,
      portGlow: 10,
      portRadius: 2.1,
  
      // scan pulses
      pulseEveryMs: 2600,
      pulseSpeed: 0.42, // px/ms-ish in param space
      pulseAlpha: 0.36,
  
      // interaction
      mouseRadius: 220,
      mouseBoost: 0.22,
    };
  
    let w = 0, h = 0, dpr = 1;
    let rafId = 0;
    let lastT = performance.now();
    let lastPulseAt = performance.now();
  
    const mouse = { x: 0, y: 0, active: false };
  
    /** @type {{x1:number,y1:number,x2:number,y2:number, bend:number, color:"cyan"|"purple"}[]} */
    let wires = [];
    /** @type {{x:number,y:number,color:"cyan"|"purple",phase:number}[]} */
    let ports = [];
    /** @type {{wireIndex:number,t:number,color:"cyan"|"purple"}[]} */
    let pulses = [];
  
    function rand(a, b) {
      return a + Math.random() * (b - a);
    }
    function clamp(v, a, b) {
      return Math.max(a, Math.min(b, v));
    }
  
    function resize() {
      dpr = window.devicePixelRatio || 1;
      w = window.innerWidth;
      h = window.innerHeight;
  
      canvas.width = Math.floor(w * dpr);
      canvas.height = Math.floor(h * dpr);
      canvas.style.width = `${w}px`;
      canvas.style.height = `${h}px`;
  
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  
      buildBlueprint();
    }
  
    function onMouseMove(e) {
      mouse.active = true;
      mouse.x = e.clientX;
      mouse.y = e.clientY;
    }
    function onMouseLeave() {
      mouse.active = false;
    }
  
    function buildBlueprint() {
      wires = [];
      ports = [];
      pulses = [];
  
      const step = CONFIG.gridStep;
  
      // place ports on a grid (not all intersections, just some)
      const cols = Math.ceil(w / step);
      const rows = Math.ceil(h / step);
  
      for (let y = 1; y < rows - 1; y++) {
        for (let x = 1; x < cols - 1; x++) {
          if (Math.random() > 0.14) continue;
          const px = x * step + rand(-8, 8);
          const py = y * step + rand(-8, 8);
          const color = Math.random() < 0.72 ? "cyan" : "purple";
          ports.push({ x: px, y: py, color, phase: rand(0, Math.PI * 2) });
        }
      }
  
      // connect nearby ports with “Manhattan + bend” style wires
      // keep it light: choose limited wires
      const maxWires = clamp(Math.round((w * h) / 50000), 22, 60);
      for (let i = 0; i < maxWires; i++) {
        const a = ports[(Math.random() * ports.length) | 0];
        const b = ports[(Math.random() * ports.length) | 0];
        if (!a || !b || a === b) continue;
  
        const dx = Math.abs(a.x - b.x);
        const dy = Math.abs(a.y - b.y);
        const dist = Math.hypot(dx, dy);
        if (dist < 80 || dist > 520) continue;
  
        const color = Math.random() < 0.65 ? "cyan" : "purple";
        wires.push({
          x1: a.x, y1: a.y,
          x2: b.x, y2: b.y,
          bend: rand(0.25, 0.75),
          color,
        });
      }
    }
  
    function drawStatic() {
      resize();
      ctx.fillStyle = CONFIG.bg;
      ctx.fillRect(0, 0, w, h);
  
      // subtle glow tint
      const g = ctx.createRadialGradient(w * 0.5, h * 0.35, 40, w * 0.5, h * 0.35, Math.max(w, h));
      g.addColorStop(0, `rgba(${CONFIG.cyan},0.10)`);
      g.addColorStop(0.5, `rgba(${CONFIG.purple},0.06)`);
      g.addColorStop(1, "rgba(0,0,0,0)");
      ctx.fillStyle = g;
      ctx.fillRect(0, 0, w, h);
  
      // draw schematic (no animation)
      renderSchematic(0, true);
    }
  
    function drawBackground() {
      ctx.fillStyle = CONFIG.bg;
      ctx.fillRect(0, 0, w, h);
  
      // very soft tint
      const g = ctx.createRadialGradient(w * 0.5, h * 0.35, 40, w * 0.5, h * 0.35, Math.max(w, h) * 0.95);
      g.addColorStop(0, `rgba(${CONFIG.cyan},${CONFIG.tintAlpha})`);
      g.addColorStop(0.45, `rgba(${CONFIG.purple},${CONFIG.tintAlpha * 0.65})`);
      g.addColorStop(1, "rgba(0,0,0,0)");
      ctx.fillStyle = g;
      ctx.fillRect(0, 0, w, h);
    }
  
    function drawGrid() {
      const step = CONFIG.gridStep;
      ctx.lineWidth = 1;
  
      for (let x = 0; x <= w; x += step) {
        ctx.beginPath();
        ctx.moveTo(x, 0);
        ctx.lineTo(x, h);
        ctx.strokeStyle = `rgba(${CONFIG.cyan},0.03)`;
        ctx.stroke();
      }
      for (let y = 0; y <= h; y += step) {
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(w, y);
        ctx.strokeStyle = `rgba(${CONFIG.cyan},0.03)`;
        ctx.stroke();
      }
    }
  
    function wirePoint(wire, t) {
      // L-shaped with a “bend” position:
      // (x1,y1) -> (xb,y1) -> (xb,y2) -> (x2,y2)
      const xb = wire.x1 + (wire.x2 - wire.x1) * wire.bend;
  
      if (t < 1 / 3) {
        const tt = t * 3;
        return { x: wire.x1 + (xb - wire.x1) * tt, y: wire.y1 };
      } else if (t < 2 / 3) {
        const tt = (t - 1 / 3) * 3;
        return { x: xb, y: wire.y1 + (wire.y2 - wire.y1) * tt };
      } else {
        const tt = (t - 2 / 3) * 3;
        return { x: xb + (wire.x2 - xb) * tt, y: wire.y2 };
      }
    }
  
    function renderSchematic(now, staticMode = false) {
      const mx = mouse.active ? mouse.x : w * 0.5;
      const my = mouse.active ? mouse.y : h * 0.5;
      const r2 = CONFIG.mouseRadius * CONFIG.mouseRadius;
  
      drawGrid();
  
      // wires
      for (let i = 0; i < wires.length; i++) {
        const wire = wires[i];
        const baseA = wire.color === "cyan" ? CONFIG.lineAlpha : CONFIG.lineAlpha * 0.85;
  
        // mouse highlight if near any sampled point
        let boost = 0;
        if (mouse.active) {
          for (let s = 0; s <= 5; s++) {
            const pt = wirePoint(wire, s / 5);
            const dx = pt.x - mx;
            const dy = pt.y - my;
            const d2 = dx * dx + dy * dy;
            if (d2 < r2) {
              boost = Math.max(boost, 1 - d2 / r2);
            }
          }
        }
  
        const a = clamp(baseA + boost * CONFIG.mouseBoost, 0, 0.5);
  
        ctx.beginPath();
        // draw the L path
        const xb = wire.x1 + (wire.x2 - wire.x1) * wire.bend;
        ctx.moveTo(wire.x1, wire.y1);
        ctx.lineTo(xb, wire.y1);
        ctx.lineTo(xb, wire.y2);
        ctx.lineTo(wire.x2, wire.y2);
  
        ctx.strokeStyle =
          wire.color === "cyan"
            ? `rgba(${CONFIG.cyan},${a})`
            : `rgba(${CONFIG.purple},${a})`;
        ctx.lineWidth = CONFIG.lineWidth + boost * 0.55;
        ctx.stroke();
      }
  
      // ports (nodes)
      for (let i = 0; i < ports.length; i++) {
        const p = ports[i];
        p.phase += staticMode ? 0 : 0.02;
  
        const pulse = 0.6 + 0.4 * Math.sin(p.phase);
        const r = CONFIG.portRadius + pulse * 0.8;
  
        let boost = 0;
        if (mouse.active) {
          const dx = p.x - mx;
          const dy = p.y - my;
          const d2 = dx * dx + dy * dy;
          if (d2 < r2) boost = 1 - d2 / r2;
        }
  
        ctx.beginPath();
        ctx.arc(p.x, p.y, r + boost * 1.1, 0, Math.PI * 2);
        const col = p.color === "cyan" ? CONFIG.cyan : CONFIG.purple;
        ctx.fillStyle = `rgba(${col},${CONFIG.portAlpha + boost * 0.20})`;
        ctx.shadowColor = `rgba(${col},${0.25 + boost * 0.25})`;
        ctx.shadowBlur = CONFIG.portGlow + boost * 10;
        ctx.fill();
        ctx.shadowBlur = 0;
  
        // tiny ring
        ctx.beginPath();
        ctx.arc(p.x, p.y, (r + 2.8) + boost * 1.2, 0, Math.PI * 2);
        ctx.strokeStyle = `rgba(${col},${0.14 + boost * 0.18})`;
        ctx.lineWidth = 1;
        ctx.stroke();
      }
  
      // pulses moving along wires
      if (!staticMode) {
        for (let i = 0; i < pulses.length; i++) {
          const pl = pulses[i];
          pl.t += (CONFIG.pulseSpeed * (now - lastT)) * 0.0005;
          if (pl.t > 1) {
            pulses.splice(i, 1);
            i--;
            continue;
          }
          const wire = wires[pl.wireIndex];
          if (!wire) continue;
  
          const pt = wirePoint(wire, pl.t);
          const col = pl.color === "cyan" ? CONFIG.cyan : CONFIG.purple;
  
          ctx.beginPath();
          ctx.arc(pt.x, pt.y, 2.1, 0, Math.PI * 2);
          ctx.fillStyle = `rgba(${col},${CONFIG.pulseAlpha})`;
          ctx.shadowColor = `rgba(${col},${CONFIG.pulseAlpha})`;
          ctx.shadowBlur = 14;
          ctx.fill();
          ctx.shadowBlur = 0;
        }
      }
  
      // vignette for readability
      const vign = ctx.createRadialGradient(
        w * 0.5, h * 0.5, Math.min(w, h) * 0.20,
        w * 0.5, h * 0.5, Math.max(w, h) * 0.85
      );
      vign.addColorStop(0, "rgba(0,0,0,0)");
      vign.addColorStop(1, `rgba(0,0,0,${CONFIG.vignetteAlpha})`);
      ctx.fillStyle = vign;
      ctx.fillRect(0, 0, w, h);
    }
  
    function tick(now) {
      const dt = Math.min(34, now - lastT);
      lastT = now;
  
      // fade/trail
      ctx.fillStyle = `rgba(0,0,0,${CONFIG.fade})`;
      ctx.fillRect(0, 0, w, h);
  
      drawBackground();
  
      // spawn a pulse periodically
      if (now - lastPulseAt > CONFIG.pulseEveryMs && wires.length) {
        lastPulseAt = now;
        const idx = (Math.random() * wires.length) | 0;
        pulses.push({
          wireIndex: idx,
          t: 0,
          color: Math.random() < 0.72 ? "cyan" : "purple",
        });
        if (pulses.length > 18) pulses.shift();
      }
  
      renderSchematic(now);
      rafId = requestAnimationFrame(tick);
    }
  
    function onVis() {
      if (document.hidden) {
        cancelAnimationFrame(rafId);
        rafId = 0;
      } else {
        lastT = performance.now();
        lastPulseAt = performance.now();
        rafId = requestAnimationFrame(tick);
      }
    }
  
    // init
    resize();
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);
  
    window.addEventListener("resize", resize, { passive: true });
    window.addEventListener("mousemove", onMouseMove, { passive: true });
    window.addEventListener("mouseleave", onMouseLeave, { passive: true });
    document.addEventListener("visibilitychange", onVis);
  
    if (reduceMotion) {
      drawStatic();
      window.addEventListener("resize", drawStatic, { passive: true });
      return;
    }
  
    rafId = requestAnimationFrame(tick);
  })();