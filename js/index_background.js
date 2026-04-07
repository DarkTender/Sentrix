/**
 * ULTRA DARK // HACKING CORE BACKGROUND (Canvas2D)
 * Upgrade oproti pôvodnej verzii:
 * - temnejšia paleta + silnejšia vineta + "ink" falloff
 * - CRT curvature + vhs noise + chromatic aberration (simulované)
 * - agresívnejší glitch: tearing, databending blocks, jitter
 * - "terminal bursts" (ERROR/TRACE/DUMP) + hex stream overlay
 * - "threat pulse" okolo kurzora (keď držíš klik/dotyk)
 *
 * Použitie:
 * 1) <canvas id="bg"></canvas>
 * 2) <script src="dark-hacker-background.js"></script>
 */
 (() => {
  const canvas = document.getElementById("bg") || (() => {
    const c = document.createElement("canvas");
    c.id = "bg";
    document.body.prepend(c);
    return c;
  })();

  const ctx = canvas.getContext("2d", { alpha: false });
  ctx.imageSmoothingEnabled = false;

  // --- DPR + resize ---
  let W = 0, H = 0, DPR = 1;
  function resize() {
    DPR = Math.max(1, Math.min(2.5, window.devicePixelRatio || 1));
    W = Math.floor(window.innerWidth);
    H = Math.floor(window.innerHeight);
    canvas.width = Math.floor(W * DPR);
    canvas.height = Math.floor(H * DPR);
    canvas.style.width = W + "px";
    canvas.style.height = H + "px";
    ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
  }
  window.addEventListener("resize", resize, { passive: true });
  resize();

  // --- EXTRA DARK palette ---
  const COLORS = {
    // deeper than before
    bg0: "#010106",
    bg1: "#020612",
    bg2: "#02010a",
    ink: "rgba(0,0,0,0.55)",

    neonG: "#00ff7a",
    neonC: "#00d7ff",
    neonP: "#7b4dff",
    toxicR: "#ff2a6d",

    dimG: "rgba(0,255,122,0.12)",
    dimC: "rgba(0,215,255,0.10)",
    dimP: "rgba(123,77,255,0.10)"
  };

  // --- Helpers ---
  const rand = (a = 1, b = 0) => b + Math.random() * (a - b);
  const randi = (a, b = 0) => (b + Math.floor(Math.random() * (a - b + 1)));
  const clamp = (v, a, b) => Math.max(a, Math.min(b, v));
  const lerp = (a, b, t) => a + (b - a) * t;

  // glyphs
  const GLYPHS =
    "アイウエオカキクケコサシスセソタチツテトナニヌネノ" +
    "0123456789ABCDEF" +
    "#$%&*+-=<>/\\[]{}()_|^~";
  const HEX = "0123456789abcdef";
  const pick = (s) => s[randi(s.length - 1)];
  const glyph = () => pick(GLYPHS);
  const hexByte = () => pick(HEX) + pick(HEX);

  // --- pointer ---
  const pointer = { x: W * 0.5, y: H * 0.5, down: false };
  function setPointer(e) {
    const t = e.touches ? e.touches[0] : e;
    pointer.x = t.clientX;
    pointer.y = t.clientY;
  }
  window.addEventListener("mousemove", setPointer, { passive: true });
  window.addEventListener("touchstart", (e) => { pointer.down = true; setPointer(e); }, { passive: true });
  window.addEventListener("touchmove", setPointer, { passive: true });
  window.addEventListener("touchend", () => { pointer.down = false; }, { passive: true });
  window.addEventListener("mousedown", () => { pointer.down = true; }, { passive: true });
  window.addEventListener("mouseup", () => { pointer.down = false; }, { passive: true });

  // --- CSS attach ---
  const style = document.createElement("style");
  style.textContent = `
    #bg{
      position: fixed;
      inset: 0;
      z-index: -1;
      width: 100vw;
      height: 100vh;
      display:block;
      background: ${COLORS.bg0};
      image-rendering: pixelated;
    }
    body{ background: ${COLORS.bg0}; }
  `;
  document.head.appendChild(style);

  // --- Digital rain (darker + denser) ---
  const fontSize = 15;
  const colW = fontSize;
  let cols = 0;
  let drops = [];
  let speeds = [];
  let trails = [];
  let phase = [];

  function resetRain() {
    cols = Math.ceil(W / colW);
    drops = new Array(cols);
    speeds = new Array(cols);
    trails = new Array(cols);
    phase = new Array(cols);
    for (let i = 0; i < cols; i++) {
      drops[i] = rand(-H / fontSize, H / fontSize);
      speeds[i] = rand(1.2, 3.6);
      trails[i] = randi(14, 44);
      phase[i] = rand(0, Math.PI * 2);
    }
  }
  resetRain();
  window.addEventListener("resize", resetRain, { passive: true });

  // --- Nodes network (more sinister) ---
  const NODES = [];
  const nodeCount = () => Math.floor(clamp((W * H) / 52000, 22, 80));
  function resetNodes() {
    NODES.length = 0;
    const n = nodeCount();
    for (let i = 0; i < n; i++) {
      NODES.push({
        x: rand(W),
        y: rand(H),
        vx: rand(0.25, 1.35) * (Math.random() < 0.5 ? -1 : 1),
        vy: rand(0.25, 1.35) * (Math.random() < 0.5 ? -1 : 1),
        r: rand(0.9, 2.4),
        p: rand(0, Math.PI * 2),
        type: Math.random() < 0.65 ? "g" : (Math.random() < 0.85 ? "c" : "p")
      });
    }
  }
  resetNodes();
  window.addEventListener("resize", resetNodes, { passive: true });

  // --- Terminal bursts ---
  const BURSTS = [];
  function spawnBurst(x, y, strength = 1) {
    const count = Math.floor(lerp(6, 22, strength));
    for (let i = 0; i < count; i++) {
      BURSTS.push({
        x: x + rand(-20, 20),
        y: y + rand(-14, 14),
        vx: rand(-0.8, 0.8),
        vy: rand(-0.6, 0.6),
        life: rand(280, 760),
        max: 0,
        text: (Math.random() < 0.35)
          ? `ERR_${randi(99, 10)}::${hexByte()}${hexByte()}`
          : (Math.random() < 0.7)
            ? `TRACE ${hexByte()}${hexByte()} ${hexByte()}${hexByte()}`
            : `DUMP ${hexByte()} ${hexByte()} ${hexByte()} ${hexByte()}`,
        col: Math.random() < 0.75 ? "g" : (Math.random() < 0.9 ? "c" : "r")
      });
    }
  }

  // --- Glitch system ---
  let glitchPower = 0;
  let hitTimer = 0;
  let jitter = 0;

  // --- Offscreen for post effects (chroma split) ---
  const off = document.createElement("canvas");
  const offCtx = off.getContext("2d", { alpha: false });
  function resizeOff() {
    off.width = Math.floor(W * DPR);
    off.height = Math.floor(H * DPR);
    offCtx.setTransform(DPR, 0, 0, DPR, 0, 0);
    offCtx.imageSmoothingEnabled = false;
  }
  resizeOff();
  window.addEventListener("resize", resizeOff, { passive: true });

  // --- Render layers ---
  function drawBase(t) {
    // ultra-dark gradient
    const g = offCtx.createLinearGradient(0, 0, 0, H);
    g.addColorStop(0, COLORS.bg0);
    g.addColorStop(0.45, COLORS.bg1);
    g.addColorStop(1, COLORS.bg2);
    offCtx.fillStyle = g;
    offCtx.fillRect(0, 0, W, H);

    // heavy vignette
    offCtx.save();
    offCtx.globalCompositeOperation = "multiply";
    const vg = offCtx.createRadialGradient(W * 0.5, H * 0.55, Math.min(W, H) * 0.10, W * 0.5, H * 0.55, Math.max(W, H) * 0.85);
    vg.addColorStop(0, "rgba(0,0,0,0)");
    vg.addColorStop(0.7, "rgba(0,0,0,0.55)");
    vg.addColorStop(1, "rgba(0,0,0,0.92)");
    offCtx.fillStyle = vg;
    offCtx.fillRect(0, 0, W, H);
    offCtx.restore();

    // subtle moving "ink" bands
    offCtx.save();
    offCtx.globalAlpha = 0.14;
    offCtx.fillStyle = COLORS.ink;
    const bandY = (t * 0.03) % (H + 260) - 130;
    offCtx.fillRect(0, bandY, W, 140);
    offCtx.fillRect(0, bandY + 220, W, 110);
    offCtx.restore();
  }

  function drawGrid(t) {
    // darker grid; only appears strongly during pulses
    const baseY = H * 0.74;
    const horizon = H * 0.34;
    const pulse = (Math.sin(t * 0.0013) * 0.5 + 0.5);
    const boost = pointer.down ? 1.0 : 0.55;
    const alpha = (0.06 + pulse * 0.08) * boost;

    offCtx.save();
    offCtx.globalAlpha = alpha;
    offCtx.strokeStyle = COLORS.dimC;
    offCtx.lineWidth = 1;

    const lines = 26;
    for (let i = -2; i <= lines + 2; i++) {
      const x = (i / lines) * W;
      offCtx.beginPath();
      offCtx.moveTo(x, baseY);
      offCtx.lineTo(W * 0.5 + (x - W * 0.5) * 0.09, horizon);
      offCtx.stroke();
    }

    const steps = 26;
    for (let j = 0; j < steps; j++) {
      const tt = j / (steps - 1);
      const y = lerp(baseY, horizon, Math.pow(tt, 1.75));
      offCtx.beginPath();
      offCtx.moveTo(0, y);
      offCtx.lineTo(W, y);
      offCtx.stroke();
    }

    // horizon glow
    offCtx.globalAlpha = alpha * 1.25;
    offCtx.strokeStyle = "rgba(0,215,255,0.20)";
    offCtx.lineWidth = 2;
    offCtx.beginPath();
    offCtx.moveTo(0, horizon);
    offCtx.lineTo(W, horizon);
    offCtx.stroke();

    offCtx.restore();
  }

  function drawRain(t) {
    offCtx.save();
    offCtx.font = `${fontSize}px ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace`;
    offCtx.textBaseline = "top";

    // deeper fade for darker trails
    offCtx.fillStyle = "rgba(0,0,0,0.22)";
    offCtx.fillRect(0, 0, W, H);

    for (let i = 0; i < cols; i++) {
      const x = i * colW;
      const y = drops[i] * fontSize;

      const cyan = (i % 9 === 0);
      const purple = (i % 27 === 0);
      const col = purple ? COLORS.neonP : (cyan ? COLORS.neonC : COLORS.neonG);

      const len = trails[i];
      for (let k = 0; k < len; k++) {
        const yy = y - k * fontSize;
        if (yy < -fontSize || yy > H + fontSize) continue;

        const a = 1 - k / len;
        const flick = 0.85 + 0.15 * Math.sin(phase[i] + t * 0.004 + k * 0.25);

        offCtx.fillStyle = purple
          ? `rgba(123,77,255,${(0.10 + 0.52 * a) * flick})`
          : cyan
            ? `rgba(0,215,255,${(0.10 + 0.52 * a) * flick})`
            : `rgba(0,255,122,${(0.09 + 0.55 * a) * flick})`;

        const ch = (k === 0)
          ? (Math.random() < 0.35 ? hexByte() : glyph())
          : (Math.random() < 0.22 ? glyph() : " ");
        if (ch !== " ") offCtx.fillText(ch, x, yy);
      }

      // head glow
      offCtx.save();
      offCtx.globalAlpha = 0.16;
      offCtx.fillStyle = col;
      offCtx.fillRect(x - 1, y - 1, colW + 2, fontSize + 2);
      offCtx.restore();

      drops[i] += speeds[i] * (0.68 + Math.sin(t * 0.0011 + i * 0.12) * 0.16);

      if (y > H + rand(0, 2600) && Math.random() > 0.965) {
        drops[i] = rand(-55, -8);
        speeds[i] = rand(1.2, 3.9);
        trails[i] = randi(14, 52);
        phase[i] = rand(0, Math.PI * 2);
      }
    }

    offCtx.restore();
  }

  function drawNodes(t) {
    const linkDist = clamp(Math.min(W, H) * 0.22, 120, 260);
    offCtx.save();
    offCtx.globalCompositeOperation = "lighter";

    for (const n of NODES) {
      n.p += 0.02;
      // slight turbulence
      const turb = 0.06 * Math.sin(t * 0.001 + n.p);
      n.x += n.vx + turb;
      n.y += n.vy - turb;

      if (n.x < 0 || n.x > W) n.vx *= -1;
      if (n.y < 0 || n.y > H) n.vy *= -1;

      // sinister attraction field
      const dx = pointer.x - n.x;
      const dy = pointer.y - n.y;
      const d = Math.hypot(dx, dy) || 1;
      const influence = pointer.down ? 0.030 : 0.010;
      if (d < 340) {
        n.vx += (dx / d) * influence;
        n.vy += (dy / d) * influence;
      }
      n.vx *= pointer.down ? 0.985 : 0.994;
      n.vy *= pointer.down ? 0.985 : 0.994;
    }

    // links
    for (let i = 0; i < NODES.length; i++) {
      for (let j = i + 1; j < NODES.length; j++) {
        const a = NODES[i], b = NODES[j];
        const dx = a.x - b.x, dy = a.y - b.y;
        const d = Math.hypot(dx, dy);
        if (d < linkDist) {
          const k = 1 - d / linkDist;
          const alpha = 0.02 + k * 0.22;
          const isP = (a.type === "p" || b.type === "p");
          const isC = (a.type === "c" || b.type === "c");
          offCtx.strokeStyle = isP
            ? `rgba(123,77,255,${alpha})`
            : isC
              ? `rgba(0,215,255,${alpha})`
              : `rgba(0,255,122,${alpha})`;
          offCtx.lineWidth = 1;

          offCtx.beginPath();
          offCtx.moveTo(a.x, a.y);
          offCtx.lineTo(b.x, b.y);
          offCtx.stroke();
        }
      }
    }

    // nodes + crosshair
    for (const n of NODES) {
      const glow = 0.5 + 0.5 * Math.sin(n.p + t * 0.0023);
      const col = n.type === "p" ? COLORS.neonP : (n.type === "c" ? COLORS.neonC : COLORS.neonG);

      offCtx.globalAlpha = 0.18 + glow * 0.22;
      offCtx.fillStyle = col;
      offCtx.beginPath();
      offCtx.arc(n.x, n.y, n.r + glow * 1.7, 0, Math.PI * 2);
      offCtx.fill();

      offCtx.globalAlpha = 0.12 + glow * 0.12;
      offCtx.strokeStyle = col;
      offCtx.lineWidth = 1;
      offCtx.beginPath();
      offCtx.moveTo(n.x - 6, n.y);
      offCtx.lineTo(n.x + 6, n.y);
      offCtx.moveTo(n.x, n.y - 6);
      offCtx.lineTo(n.x, n.y + 6);
      offCtx.stroke();
    }

    offCtx.restore();
  }

  function drawThreatPulse(t) {
    const base = pointer.down ? 1 : 0.45;
    const pulse = (Math.sin(t * 0.008) * 0.5 + 0.5);
    const r0 = 60 + pulse * 80;
    const r1 = 240 + pulse * 220;

    offCtx.save();
    offCtx.globalCompositeOperation = "screen";
    offCtx.globalAlpha = 0.08 * base + pulse * 0.10 * base;

    const g = offCtx.createRadialGradient(pointer.x, pointer.y, r0, pointer.x, pointer.y, r1);
    g.addColorStop(0, "rgba(255,42,109,0.18)");
    g.addColorStop(0.35, "rgba(0,255,122,0.10)");
    g.addColorStop(1, "rgba(0,0,0,0)");
    offCtx.fillStyle = g;
    offCtx.fillRect(0, 0, W, H);

    offCtx.restore();
  }

  function drawBursts(dt) {
    offCtx.save();
    offCtx.globalCompositeOperation = "lighter";
    offCtx.font = `12px ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace`;
    offCtx.textBaseline = "top";

    for (let i = BURSTS.length - 1; i >= 0; i--) {
      const b = BURSTS[i];
      b.life -= dt;
      if (b.max === 0) b.max = b.life;

      b.x += b.vx;
      b.y += b.vy;

      const a = clamp(b.life / b.max, 0, 1);
      const col = (b.col === "r") ? COLORS.toxicR : (b.col === "c" ? COLORS.neonC : COLORS.neonG);

      offCtx.globalAlpha = 0.08 + a * 0.42;
      offCtx.fillStyle = col;
      offCtx.fillText(b.text, b.x, b.y);

      if (b.life <= 0) BURSTS.splice(i, 1);
    }

    offCtx.restore();
  }

  function drawHUD(t) {
    offCtx.save();
    offCtx.globalCompositeOperation = "lighter";
    offCtx.font = `12px ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace`;

    // minimal, colder, darker HUD
    offCtx.globalAlpha = 0.18;
    offCtx.strokeStyle = COLORS.dimG;
    offCtx.strokeRect(16, 14, 210, 86);

    offCtx.globalAlpha = 0.22;
    offCtx.fillStyle = COLORS.neonC;
    const timeStr = new Date().toISOString().slice(0, 19).replace("T", " ");
    offCtx.fillText(`UTC ${timeStr}`, 26, 26);

    offCtx.fillStyle = COLORS.neonG;
    offCtx.fillText(`INTRUSION ${pointer.down ? "ACTIVE" : "IDLE"}`, 26, 44);

    offCtx.fillStyle = COLORS.toxicR;
    offCtx.globalAlpha = 0.16 + glitchPower * 0.18;
    offCtx.fillText(`THREAT LVL ${Math.floor(lerp(12, 99, glitchPower))}`, 26, 62);

    offCtx.globalAlpha = 0.18;
    offCtx.fillStyle = COLORS.neonP;
    offCtx.fillText(`NODES ${NODES.length}  RAIN ${cols}`, 26, 80);

    offCtx.restore();
  }

  function drawScanlinesAndNoise(t) {
    offCtx.save();

    // scanlines
    offCtx.globalCompositeOperation = "multiply";
    offCtx.globalAlpha = 0.30;
    const lineH = 2;
    const offset = (t * 0.07) % (lineH * 2);
    for (let y = -offset; y < H; y += lineH * 2) {
      offCtx.fillStyle = "rgba(0,0,0,0.65)";
      offCtx.fillRect(0, y, W, lineH);
    }

    // VHS noise specks
    offCtx.globalCompositeOperation = "screen";
    offCtx.globalAlpha = 0.10;
    const specks = 220;
    for (let i = 0; i < specks; i++) {
      const x = rand(W), y = rand(H);
      const a = Math.random() * 0.22;
      offCtx.fillStyle = `rgba(255,255,255,${a})`;
      offCtx.fillRect(x, y, 1, 1);
    }

    // moving “tracking” bar
    offCtx.globalCompositeOperation = "screen";
    const sY = (t * 0.10) % (H + 200) - 100;
    const sg = offCtx.createLinearGradient(0, sY - 50, 0, sY + 50);
    sg.addColorStop(0, "rgba(0,0,0,0)");
    sg.addColorStop(0.5, "rgba(0,215,255,0.10)");
    sg.addColorStop(1, "rgba(0,0,0,0)");
    offCtx.fillStyle = sg;
    offCtx.fillRect(0, sY - 50, W, 100);

    offCtx.restore();
  }

  function applyGlitch(now) {
    // schedule heavier hits; even heavier when holding click
    const baseChance = pointer.down ? 0.06 : 0.028;
    if (hitTimer <= 0 && Math.random() < baseChance) {
      hitTimer = randi(8, 24);
      glitchPower = rand(pointer.down ? 0.55 : 0.35, 1.0);
      jitter = rand(1, 6) * glitchPower;

      // terminal burst at cursor / random
      if (pointer.down) spawnBurst(pointer.x, pointer.y, glitchPower);
      if (Math.random() < 0.6) spawnBurst(rand(W * 0.2, W * 0.8), rand(H * 0.2, H * 0.8), glitchPower * 0.8);
    } else if (hitTimer > 0) {
      hitTimer--;
      glitchPower *= 0.90;
      jitter *= 0.88;
    } else {
      glitchPower *= 0.985;
      jitter *= 0.97;
    }

    // base draw
    ctx.setTransform(DPR, 0, 0, DPR, 0, 0);

    // global jitter shake
    const jx = (Math.random() - 0.5) * jitter;
    const jy = (Math.random() - 0.5) * jitter;

    // chroma split (fake aberration): draw offscreen 3x shifted
    ctx.clearRect(0, 0, W, H);
    ctx.globalCompositeOperation = "source-over";

    const split = 1 + 10 * glitchPower;
    ctx.globalAlpha = 0.95;
    ctx.drawImage(off, jx - split * 0.6, jy, W, H);
    ctx.globalCompositeOperation = "screen";
    ctx.globalAlpha = 0.22 + 0.18 * glitchPower;
    ctx.fillStyle = "rgba(0,215,255,0.35)";
    ctx.drawImage(off, jx + split * 0.8, jy + 0.2, W, H);

    ctx.globalAlpha = 0.20 + 0.16 * glitchPower;
    ctx.fillStyle = "rgba(255,42,109,0.22)";
    ctx.drawImage(off, jx - split * 0.9, jy - 0.2, W, H);

    // tearing slices
    if (glitchPower > 0.06) {
      const slices = Math.floor(lerp(4, 26, glitchPower));
      for (let i = 0; i < slices; i++) {
        const y = rand(0, H);
        const h = rand(6, 34);
        const dx = rand(-40, 40) * glitchPower;
        const dy = rand(-4, 4) * glitchPower;
        ctx.globalAlpha = 0.92;
        ctx.globalCompositeOperation = "source-over";
        ctx.drawImage(canvas, 0, y, W, h, dx, y + dy, W, h);
      }

      // databending blocks
      if (Math.random() < 0.35 * glitchPower) {
        ctx.save();
        ctx.globalCompositeOperation = "screen";
        ctx.globalAlpha = 0.10 + 0.15 * glitchPower;
        for (let i = 0; i < 10; i++) {
          ctx.fillStyle = Math.random() < 0.5 ? COLORS.neonP : (Math.random() < 0.5 ? COLORS.neonC : COLORS.toxicR);
          ctx.fillRect(rand(W), rand(H), rand(30, 160), rand(6, 26));
        }
        ctx.restore();
      }
    }

    // CRT curvature vignette (subtle)
    ctx.save();
    ctx.globalCompositeOperation = "multiply";
    ctx.globalAlpha = 0.55;
    const rg = ctx.createRadialGradient(W * 0.5, H * 0.52, Math.min(W, H) * 0.35, W * 0.5, H * 0.52, Math.max(W, H) * 0.78);
    rg.addColorStop(0, "rgba(0,0,0,0)");
    rg.addColorStop(1, "rgba(0,0,0,0.85)");
    ctx.fillStyle = rg;
    ctx.fillRect(0, 0, W, H);
    ctx.restore();
  }

  // --- Main loop ---
  let last = performance.now();
  function frame(now) {
    const dt = clamp(now - last, 0, 45);
    last = now;

    // draw into offscreen (clean pipeline)
    offCtx.setTransform(DPR, 0, 0, DPR, 0, 0);

    drawBase(now);
    drawGrid(now);

    // threat pulse (under rain)
    drawThreatPulse(now);

    drawRain(now);
    drawNodes(now);

    // bursts + HUD + scanlines
    drawBursts(dt);
    drawHUD(now);
    drawScanlinesAndNoise(now);

    // apply glitch & post
    applyGlitch(now);

    requestAnimationFrame(frame);
  }

  // start with darkness
  ctx.fillStyle = COLORS.bg0;
  ctx.fillRect(0, 0, W, H);
  requestAnimationFrame(frame);
})();