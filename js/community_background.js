/**
 * CYBERGRID — Perspective grid + scanlines (lightweight)
 * Requirements in HTML:
 *   <canvas id="neural-canvas"></canvas>
 */
 (() => {
  const canvas = document.getElementById("neural-canvas");
  if (!canvas) return;

  const ctx = canvas.getContext("2d", { alpha: true });

  const reduceMotion = window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;
  const CONFIG = {
    bg: "rgba(2,6,23,1)",

    // grid look
    horizon: 0.5,          // 0..1 (higher = horizon lower)
    speed: 0.9,            // forward motion
    lineAlpha: 0.62,
    majorLineAlpha: 0.88,
    glowAlpha: 0.10,

    // spacing
    baseSpacing: 28,        // px near bottom
    depthLines: 40,         // how many horizontals

    // colors (cyan/purple cyber)
    cyan: "56,189,248",
    purple: "168,85,247",

    // scanlines
    scanAlpha: 0.06,
    scanStep: 0,

    // subtle glitch pulse
    glitchEveryMs: 90000,
    glitchForMs: 18000,
  };

  let w = 0, h = 0, dpr = 1;
  let t0 = performance.now();
  let rafId = 0;

  const mouse = { x: 0.5, y: 0.5, active: false };
  let glitchUntil = 0;
  let nextGlitchAt = t0 + CONFIG.glitchEveryMs;

  function resize() {
    dpr = window.devicePixelRatio || 1;
    w = window.innerWidth;
    h = window.innerHeight;
    canvas.width = Math.floor(w * dpr);
    canvas.height = Math.floor(h * dpr);
    canvas.style.width = `${w}px`;
    canvas.style.height = `${h}px`;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function onMouseMove(e) {
    mouse.active = true;
    mouse.x = e.clientX / Math.max(1, w);
    mouse.y = e.clientY / Math.max(1, h);
  }
  function onMouseLeave() {
    mouse.active = false;
    mouse.x = 0.5;
    mouse.y = 0.5;
  }

  function drawStatic() {
    resize();
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);

    // subtle gradient glow
    const g = ctx.createRadialGradient(w * 0.5, h * 0.35, 40, w * 0.5, h * 0.35, Math.max(w, h));
    g.addColorStop(0, `rgba(${CONFIG.cyan},0.12)`);
    g.addColorStop(0.45, `rgba(${CONFIG.purple},0.07)`);
    g.addColorStop(1, "rgba(0,0,0,0)");
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, w, h);

    // static scanlines
    ctx.fillStyle = `rgba(255,255,255,${CONFIG.scanAlpha})`;
    for (let y = 0; y < h; y += CONFIG.scanStep) {
      ctx.fillRect(0, y, w, 1);
    }
  }

  function drawScanlines(phase) {
    // phase is animated small offset
    ctx.fillStyle = `rgba(255,255,255,${CONFIG.scanAlpha})`;
    const off = (phase | 0) % CONFIG.scanStep;
    for (let y = off; y < h; y += CONFIG.scanStep) {
      ctx.fillRect(0, y, w, 1);
    }
  }

  function drawGrid(now) {
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);

    // background glow
    const glow = ctx.createRadialGradient(w * 0.5, h * 0.35, 30, w * 0.5, h * 0.35, Math.max(w, h) * 0.95);
    glow.addColorStop(0, `rgba(${CONFIG.cyan},${CONFIG.glowAlpha})`);
    glow.addColorStop(0.4, `rgba(${CONFIG.purple},${CONFIG.glowAlpha * 0.8})`);
    glow.addColorStop(1, "rgba(0,0,0,0)");
    ctx.fillStyle = glow;
    ctx.fillRect(0, 0, w, h);

    // mouse affects vanishing point slightly
    const mx = mouse.active ? mouse.x : 0.5;
    const my = mouse.active ? mouse.y : 0.5;

    const vpX = w * (0.5 + (mx - 0.5) * 0.20);
    const horizonY = h * (CONFIG.horizon + (my - 0.5) * 0.08);

    // forward motion (scroll)
    const elapsed = (now - t0) * 0.001;
    const scroll = (elapsed * CONFIG.speed) % 1;

    // grid bounds: trapezoid
    const bottomW = w * 1.2;
    const topW = w * 0.08;
    const bottomY = h + 40;

    // vertical lines (perspective)
    const vCount = 26;
    for (let i = 0; i <= vCount; i++) {
      const u = i / vCount; // 0..1 across bottom
      const xBottom = (w - bottomW) * 0.5 + u * bottomW;
      const xTop = vpX + (u - 0.5) * topW;

      const major = i % 5 === 0;

      ctx.beginPath();
      ctx.moveTo(xBottom, bottomY);
      ctx.lineTo(xTop, horizonY);
      ctx.strokeStyle = major
        ? `rgba(${CONFIG.cyan},${CONFIG.majorLineAlpha})`
        : `rgba(${CONFIG.cyan},${CONFIG.lineAlpha})`;
      ctx.lineWidth = major ? 1.35 : 1.0;
      ctx.stroke();
    }

    // horizontal lines (depth)
    // Use non-linear spacing to fake perspective
    for (let j = 0; j < CONFIG.depthLines; j++) {
      // z goes 0 (near) -> 1 (far)
      const z = (j + scroll) / CONFIG.depthLines;
      const p = 1 - Math.pow(1 - z, 2.4); // ease (denser far away)

      const y = bottomY - (bottomY - horizonY) * p;

      // width shrinks toward horizon
      const wAt = bottomW - (bottomW - topW) * p;
      const xL = vpX - wAt * 0.5;
      const xR = vpX + wAt * 0.5;

      const major = j % 6 === 0;

      ctx.beginPath();
      ctx.moveTo(xL, y);
      ctx.lineTo(xR, y);
      ctx.strokeStyle = major
        ? `rgba(${CONFIG.purple},${CONFIG.majorLineAlpha * 0.95})`
        : `rgba(${CONFIG.purple},${CONFIG.lineAlpha * 0.9})`;
      ctx.lineWidth = major ? 1.35 : 1.0;
      ctx.stroke();
    }

    // subtle “terminal vignette”
    const vign = ctx.createRadialGradient(w * 0.5, h * 0.55, Math.min(w, h) * 0.15, w * 0.5, h * 0.55, Math.max(w, h) * 0.7);
    vign.addColorStop(0, "rgba(0,0,0,0)");
    vign.addColorStop(1, "rgba(0,0,0,0.65)");
    ctx.fillStyle = vign;
    ctx.fillRect(0, 0, w, h);

    // glitch pulse (short and subtle)
    if (now < glitchUntil) {
      const bands = 5;
      for (let b = 0; b < bands; b++) {
        const y = (Math.random() * h) | 0;
        const hh = 6 + ((Math.random() * 18) | 0);
        const shift = (Math.random() * 18 - 9);

        ctx.drawImage(canvas, 0, y, w, hh, shift, y, w, hh);
        ctx.fillStyle = `rgba(${CONFIG.cyan},0.05)`;
        ctx.fillRect(0, y, w, 1);
      }
    }

    // scanlines
    drawScanlines(now * 0.02);
  }

  function loop(now) {
    if (now >= nextGlitchAt) {
      glitchUntil = now + CONFIG.glitchForMs;
      nextGlitchAt = now + CONFIG.glitchEveryMs + (Math.random() * 5000) | 0;
    }

    drawGrid(now);
    rafId = requestAnimationFrame(loop);
  }

  function onVis() {
    if (document.hidden) {
      cancelAnimationFrame(rafId);
      rafId = 0;
    } else {
      t0 = performance.now();
      rafId = requestAnimationFrame(loop);
    }
  }

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