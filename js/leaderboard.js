const canvas = document.getElementById("leaderboard-bg");
const ctx = canvas.getContext("2d");

let w, h;

function resize() {
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}

resize();
window.addEventListener("resize", resize);

const towers = [];

for (let i = 0; i < 60; i++) {

    towers.push({
        x: Math.random() * window.innerWidth,
        height: 50 + Math.random() * 500,
        width: 2 + Math.random() * 4,
        speed: 0.2 + Math.random() * 0.5,
        pulse: Math.random() * 100
    });
}

function draw() {

    ctx.clearRect(0, 0, w, h);

    // glow pozadie
    const bg = ctx.createRadialGradient(
        w / 2,
        h,
        0,
        w / 2,
        h,
        h
    );

    bg.addColorStop(0, "rgba(0,229,255,0.05)");
    bg.addColorStop(1, "rgba(0,0,0,0)");

    ctx.fillStyle = bg;
    ctx.fillRect(0, 0, w, h);

    for (const t of towers) {

        t.pulse += 0.02;

        const alpha =
            0.1 +
            Math.sin(t.pulse) * 0.05;

        const grad = ctx.createLinearGradient(
            0,
            h,
            0,
            h - t.height
        );

        grad.addColorStop(0, "rgba(0,229,255,0)");
        grad.addColorStop(1, `rgba(0,229,255,${alpha + 0.2})`);

        ctx.strokeStyle = grad;
        ctx.lineWidth = t.width;

        ctx.beginPath();
        ctx.moveTo(t.x, h);
        ctx.lineTo(t.x, h - t.height);
        ctx.stroke();

        // svetelný impulz
        const pulseY =
            h -
            ((performance.now() * t.speed * 0.1) %
            t.height);

        ctx.beginPath();
        ctx.arc(t.x, pulseY, 3, 0, Math.PI * 2);

        ctx.fillStyle = "#ffffff";
        ctx.shadowBlur = 20;
        ctx.shadowColor = "#00e5ff";
        ctx.fill();
    }

    // TOP 3 stĺpy
    const topX = [w * 0.35, w * 0.5, w * 0.65];
    const heights = [650, 850, 750];

    for (let i = 0; i < 3; i++) {

        const x = topX[i];
        const towerHeight = heights[i];

        const grad = ctx.createLinearGradient(
            0,
            h,
            0,
            h - towerHeight
        );

        grad.addColorStop(0, "rgba(91,91,255,0)");
        grad.addColorStop(1, "rgba(91,91,255,0.4)");

        ctx.strokeStyle = grad;
        ctx.lineWidth = 8;

        ctx.beginPath();
        ctx.moveTo(x, h);
        ctx.lineTo(x, h - towerHeight);
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(
            x,
            h - towerHeight,
            8,
            0,
            Math.PI * 2
        );

        ctx.fillStyle = "#5b5bff";
        ctx.shadowBlur = 30;
        ctx.shadowColor = "#5b5bff";
        ctx.fill();
    }

    ctx.shadowBlur = 0;

    requestAnimationFrame(draw);
}

draw();