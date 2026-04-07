/**
 * ROADMAPFLOW — Subtle flowing routes + milestone nodes (for roadmap pages)
 * Requirements in HTML:
 *   <canvas id="neural-canvas"></canvas>
 *
 * Design goal:
 * - feels like "timeline/roadmap" (paths + nodes)
 * - stays readable under content (low contrast)
 * - lightweight (few curves, few nodes)
 */
 (() => {
  const canvas = document.getElementById("neural-canvas");
  if (!canvas) return;

  const ctx = canvas.getContext("2d", { alpha: true });

  const reduceMotion =
    window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;

  const CONFIG = {
    bg: "rgba(2,6,23,1)",

    // palette
    cyan: "56,189,248",
    purple: "168,85,247",

    // readability first
    fade: 0.10,                 // trail fade (higher = cleaner)
    routeAlpha: 0.16,           // base route opacity
    routeAlphaNearMouse: 0.26,  // highlight near mouse
    nodeAlpha: 0.34,
    nodeGlow: 12,

    // layout
    routeCount: 7,
    nodesPerRouteMin: 4,
    nodesPerRouteMax: 7,

    // motion
    flowSpeed: 0.16,            // dot speed along routes
    wobble: 0.6,                // small movement of control points

    // interaction
    mouseRadius: 220,
  };

  let w = 0, h = 0, dpr = 1;
  let rafId = 0;
  let lastT = performance.now();
  let t0 = performance.now();

  const mouse = { x: 0, y: 0, active: false };

  /** @type {{p0:{x:number,y:number},p1:{x:number,y:number},p2:{x:number,y:number},p3:{x:number,y:number}, phase:number, nodes:{t:number, r:number, phase:number}[], flows:{t:number, s:number}[] }[]} */
  let routes = [];

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
    buildRoutes();
  }

  function onMouseMove(e) {
    mouse.active = true;
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  }
  function onMouseLeave() {
    mouse.active = false;
  }

  function cubicAt(p0, p1, p2, p3, t) {
    const u = 1 - t;
    const tt = t * t;
    const uu = u * u;
    const uuu = uu * u;
    const ttt = tt * t;

    return {
      x: uuu * p0.x + 3 * uu * t * p1.x + 3 * u * tt * p2.x + ttt * p3.x,
      y: uuu * p0.y + 3 * uu * t * p1.y + 3 * u * tt * p2.y + ttt * p3.y,
    };
  }

  function buildRoutes() {
    routes = [];
    const marginX = w * 0.08;
    const marginY = h * 0.10;

    for (let i = 0; i < CONFIG.routeCount; i++) {
      // left->right gentle routes (timeline-ish)
      const yBase = marginY + (i / (CONFIG.routeCount - 1 || 1)) * (h - marginY * 2);
      const jitter = rand(-h * 0.05, h * 0.05);

      const p0 = { x: -80, y: clamp(yBase + jitter, 40, h - 40) };
      const p3 = { x: w + 80, y: clamp(yBase + rand(-h * 0.06, h * 0.06), 40, h - 40) };

      const p1 = { x: marginX + rand(0, w * 0.18), y: p0.y + rand(-h * 0.12, h * 0.12) };
      const p2 = { x: w - marginX - rand(0, w * 0.18), y: p3.y + rand(-h * 0.12, h * 0.12) };

      const nodeCount = (rand(CONFIG.nodesPerRouteMin, CONFIG.nodesPerRouteMax + 1) | 0);
      const nodes = [];
      for (let n = 0; n < nodeCount; n++) {
        // avoid edges (milestones in the middle area)
        const t = clamp(rand(0.08, 0.92), 0.08, 0.92);
        nodes.push({
          t,
          r: rand(2.2, 3.8),
          phase: rand(0, Math.PI * 2),
        });
      }

      // moving “flow dots”
      const flows = [];
      const flowCount = (2 + (Math.random() * 3) | 0);
      for (let f = 0; f < flowCount; f++) {
        flows.push({
          t: rand(0, 1),
          s: rand(0.7, 1.25), // speed multiplier
        });
      }

      routes.push({
        p0, p1, p2, p3,
        phase: rand(0, Math.PI * 2),
        nodes,
        flows,
      });
    }
  }

  function drawStatic() {
    resize();
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);

    // subtle glow vignette
    const g = ctx.createRadialGradient(w * 0.5, h * 0.35, 50, w * 0.5, h * 0.35, Math.max(w, h));
    g.addColorStop(0, `rgba(${CONFIG.cyan},0.10)`);
    g.addColorStop(0.5, `rgba(${CONFIG.purple},0.06)`);
    g.addColorStop(1, "rgba(0,0,0,0)");
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, w, h);

    // static routes (no motion)
    for (const r of routes) {
      ctx.beginPath();
      ctx.moveTo(r.p0.x, r.p0.y);
      ctx.bezierCurveTo(r.p1.x, r.p1.y, r.p2.x, r.p2.y, r.p3.x, r.p3.y);
      ctx.strokeStyle = `rgba(${CONFIG.cyan},0.14)`;
      ctx.lineWidth = 1;
      ctx.stroke();
    }
  }

  function drawBackground() {
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);

    const g = ctx.createRadialGradient(w * 0.5, h * 0.35, 50, w * 0.5, h * 0.35, Math.max(w, h) * 0.95);
    g.addColorStop(0, `rgba(${CONFIG.cyan},0.11)`);
    g.addColorStop(0.45, `rgba(${CONFIG.purple},0.07)`);
    g.addColorStop(1, "rgba(0,0,0,0)");
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, w, h);
  }

  function step(dt, now) {
    // fade (keeps it clean under text)
    ctx.fillStyle = `rgba(0,0,0,${CONFIG.fade})`;
    ctx.fillRect(0, 0, w, h);

    drawBackground();

    const mx = mouse.active ? mouse.x : w * 0.5;
    const my = mouse.active ? mouse.y : h * 0.45;
    const r2 = CONFIG.mouseRadius * CONFIG.mouseRadius;

    // animate control points slightly (wobble)
    const time = (now - t0) * 0.001;

    for (const route of routes) {
      route.phase += dt * 0.001;

      const wob = Math.sin(route.phase + time) * CONFIG.wobble;

      const p0 = route.p0;
      const p3 = route.p3;
      const p1 = { x: route.p1.x, y: route.p1.y + wob * 0.35 };
      const p2 = { x: route.p2.x, y: route.p2.y - wob * 0.35 };

      // route highlight depends on nearest sample point distance to mouse
      // (cheap: sample a few points)
      let near = false;
      for (let s = 0; s <= 6; s++) {
        const t = s / 6;
        const pt = cubicAt(p0, p1, p2, p3, t);
        const dx = pt.x - mx;
        const dy = pt.y - my;
        if (dx * dx + dy * dy < r2) { near = true; break; }
      }

      const a = near ? CONFIG.routeAlphaNearMouse : CONFIG.routeAlpha;

      // draw route
      ctx.beginPath();
      ctx.moveTo(p0.x, p0.y);
      ctx.bezierCurveTo(p1.x, p1.y, p2.x, p2.y, p3.x, p3.y);
      ctx.strokeStyle = `rgba(${CONFIG.cyan},${a})`;
      ctx.lineWidth = near ? 1.35 : 1.0;
      ctx.stroke();

      // draw nodes (milestones)
      for (const n of route.nodes) {
        n.phase += dt * 0.0018;
        const pulse = 0.6 + 0.4 * Math.sin(n.phase);

        const pt = cubicAt(p0, p1, p2, p3, n.t);

        // slightly attract glow when mouse near
        const dx = pt.x - mx;
        const dy = pt.y - my;
        const d2 = dx * dx + dy * dy;
        const boost = d2 < r2 ? (1 - d2 / r2) : 0;

        const rr = n.r + pulse * 1.1 + boost * 1.2;

        ctx.beginPath();
        ctx.arc(pt.x, pt.y, rr, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(${CONFIG.purple},${CONFIG.nodeAlpha + boost * 0.18})`;
        ctx.shadowColor = `rgba(${CONFIG.purple},${0.30 + boost * 0.25})`;
        ctx.shadowBlur = CONFIG.nodeGlow + boost * 10;
        ctx.fill();
        ctx.shadowBlur = 0;
      }

      // flow dots moving along the route
      for (const f of route.flows) {
        f.t += (CONFIG.flowSpeed * f.s * dt) * 0.0008;
        if (f.t > 1) f.t -= 1;

        const pt = cubicAt(p0, p1, p2, p3, f.t);
        ctx.beginPath();
        ctx.arc(pt.x, pt.y, 1.8, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(${CONFIG.cyan},0.32)`;
        ctx.shadowColor = `rgba(${CONFIG.cyan},0.25)`;
        ctx.shadowBlur = 10;
        ctx.fill();
        ctx.shadowBlur = 0;
      }
    }

    // subtle vignette to keep center readable
    const vign = ctx.createRadialGradient(w * 0.5, h * 0.5, Math.min(w, h) * 0.18, w * 0.5, h * 0.5, Math.max(w, h) * 0.8);
    vign.addColorStop(0, "rgba(0,0,0,0)");
    vign.addColorStop(1, "rgba(0,0,0,0.60)");
    ctx.fillStyle = vign;
    ctx.fillRect(0, 0, w, h);
  }

  function loop(now) {
    const dt = Math.min(34, now - lastT);
    lastT = now;

    step(dt, now);
    rafId = requestAnimationFrame(loop);
  }

  function onVis() {
    if (document.hidden) {
      cancelAnimationFrame(rafId);
      rafId = 0;
    } else {
      lastT = performance.now();
      rafId = requestAnimationFrame(loop);
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

  rafId = requestAnimationFrame(loop);
})();