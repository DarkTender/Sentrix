/**
 * WRITEUPSTREAM — Subtle terminal/log stream background (for writeups)
 * Requirements in HTML:
 *   <canvas id="neural-canvas"></canvas>
 *
 * Tips:
 * - Keep opacity low so article text remains readable.
 * - Works best under a semi-opaque page background overlay.
 */
 (() => {
  const canvas = document.getElementById("neural-canvas");
  if (!canvas) return;

  const ctx = canvas.getContext("2d", { alpha: true });

  const reduceMotion =
    window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;

  const CONFIG = {
    // overall mood
    bg: "rgba(2,6,23,1)", // deep navy
    fade: 0.10,           // higher = more fade (less clutter)

    // typography
    fontFamily:
      'ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
    fontSize: 14,         // base px (will scale slightly with DPR)
    lineHeight: 18,

    // density / speed
    columnsPer1200px: 56, // how many columns across a 1200px width
    spawnChance: 0.075,   // chance per column per frame to spawn a symbol
    speedMin: 0.35,
    speedMax: 0.95,

    // colors (cyan/purple like your theme)
    cyan: "56,189,248",
    purple: "168,85,247",
    green: "34,197,94",

    // opacity ranges
    symbolAlphaMin: 0.10,
    symbolAlphaMax: 0.26,
    glowAlpha: 0.10,

    // mouse halo
    haloRadius: 220,
    haloAlpha: 0.16,

    // occasional “log burst”
    burstEveryMs: 6500,
    burstForMs: 320,
  };

  let w = 0, h = 0, dpr = 1;
  let rafId = 0;
  let lastT = performance.now();

  const mouse = { x: 0, y: 0, active: false };

  // A “glyph” is just a character + position + velocity.
  /** @type {{x:number,y:number,vy:number,ch:string,a:number,r:number,g:number,b:number}[]} */
  let glyphs = [];

  let nextBurstAt = performance.now() + CONFIG.burstEveryMs;
  let burstUntil = 0;

  function rand(a, b) {
    return a + Math.random() * (b - a);
  }
  function clamp(v, a, b) {
    return Math.max(a, Math.min(b, v));
  }

  // Looks like terminals / writeups: mix of hex, brackets, arrows, keywords.
  const TOKENS = [
    "0","1","A","B","C","D","E","F",
    "{","}","[","]","(",")","<",">",
    "/","\\",";","=",":","_","-","+","*",
    "0x","::","=>","<-",
    "GET","POST","SSH","JWT","RCE","XSS","SQLi","CVE"
  ];

  function pickToken() {
    const t = TOKENS[(Math.random() * TOKENS.length) | 0];
    return t;
  }

  function pickColor() {
    const p = Math.random();
    if (p < 0.68) return [56, 189, 248];   // cyan
    if (p < 0.92) return [168, 85, 247];   // purple
    return [34, 197, 94];                  // green accent
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

    // reset density gently
    if (glyphs.length > 900) glyphs = glyphs.slice(0, 650);
  }

  function onMouseMove(e) {
    mouse.active = true;
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  }
  function onMouseLeave() {
    mouse.active = false;
  }

  function drawStatic() {
    resize();
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);

    // subtle vignette
    const vign = ctx.createRadialGradient(
      w * 0.5, h * 0.35, Math.min(w, h) * 0.15,
      w * 0.5, h * 0.35, Math.max(w, h) * 0.7
    );
    vign.addColorStop(0, `rgba(${CONFIG.cyan},0.10)`);
    vign.addColorStop(0.45, `rgba(${CONFIG.purple},0.06)`);
    vign.addColorStop(1, "rgba(0,0,0,0.65)");
    ctx.fillStyle = vign;
    ctx.fillRect(0, 0, w, h);
  }

  function drawBackground() {
    ctx.fillStyle = CONFIG.bg;
    ctx.fillRect(0, 0, w, h);

    // terminal-ish glow (very subtle)
    const g = ctx.createRadialGradient(
      w * 0.5, h * 0.35, 40,
      w * 0.5, h * 0.35, Math.max(w, h) * 0.95
    );
    g.addColorStop(0, `rgba(${CONFIG.cyan},0.11)`);
    g.addColorStop(0.45, `rgba(${CONFIG.purple},0.07)`);
    g.addColorStop(1, "rgba(0,0,0,0)");
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, w, h);

    // mouse halo to guide focus (optional but nice)
    if (mouse.active) {
      const halo = ctx.createRadialGradient(
        mouse.x, mouse.y, 10,
        mouse.x, mouse.y, CONFIG.haloRadius
      );
      halo.addColorStop(0, `rgba(${CONFIG.cyan},${CONFIG.haloAlpha})`);
      halo.addColorStop(0.5, `rgba(${CONFIG.purple},${CONFIG.haloAlpha * 0.7})`);
      halo.addColorStop(1, "rgba(0,0,0,0)");
      ctx.fillStyle = halo;
      ctx.fillRect(0, 0, w, h);
    }
  }

  function spawn(dt) {
    // choose number of columns based on width
    const cols = Math.max(24, Math.round((w / 1200) * CONFIG.columnsPer1200px));
    const colW = w / cols;

    // burst = temporarily more spawns (like "log spam")
    const now = performance.now();
    const burstMul = now < burstUntil ? 2.4 : 1.0;

    for (let c = 0; c < cols; c++) {
      if (Math.random() > CONFIG.spawnChance * burstMul) continue;

      const x = (c + rand(0.15, 0.85)) * colW;
      const y = rand(-40, h * 0.25);

      const ch = pickToken();
      const [r, g, b] = pickColor();

      glyphs.push({
        x,
        y,
        vy: rand(CONFIG.speedMin, CONFIG.speedMax) * (0.06 * dt),
        ch,
        a: rand(CONFIG.symbolAlphaMin, CONFIG.symbolAlphaMax),
        r, g, b,
      });
    }

    // keep size bounded
    if (glyphs.length > 1100) glyphs.splice(0, glyphs.length - 1100);
  }

  function drawGlyphs() {
    // typography
    const fs = CONFIG.fontSize;
    ctx.font = `${fs}px ${CONFIG.fontFamily}`;
    ctx.textBaseline = "top";

    for (let i = 0; i < glyphs.length; i++) {
      const g = glyphs[i];

      // soft glow (very small)
      ctx.shadowColor = `rgba(${g.r},${g.g},${g.b},${CONFIG.glowAlpha})`;
      ctx.shadowBlur = 10;

      ctx.fillStyle = `rgba(${g.r},${g.g},${g.b},${g.a})`;
      ctx.fillText(g.ch, g.x, g.y);

      ctx.shadowBlur = 0;
    }
  }

  function update(dt) {
    // fade previous frame (keeps it subtle for readability)
    ctx.fillStyle = `rgba(0,0,0,${CONFIG.fade})`;
    ctx.fillRect(0, 0, w, h);

    drawBackground();
    spawn(dt);

    // move glyphs
    for (let i = 0; i < glyphs.length; i++) {
      glyphs[i].y += glyphs[i].vy * dt;

      // slow fade out as they go down
      glyphs[i].a *= 0.9992;

      // remove if off-screen or invisible
      if (glyphs[i].y > h + 60 || glyphs[i].a < 0.03) {
        glyphs.splice(i, 1);
        i--;
      }
    }

    drawGlyphs();
  }

  function loop(t) {
    const dt = Math.min(34, t - lastT);
    lastT = t;

    const now = performance.now();
    if (now >= nextBurstAt) {
      burstUntil = now + CONFIG.burstForMs;
      nextBurstAt = now + CONFIG.burstEveryMs + (Math.random() * 3500) | 0;
    }

    update(dt);
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