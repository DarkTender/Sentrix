const canvas = document.getElementById("bgCanvas");
const ctx = canvas.getContext("2d");

let w, h;
let time = 0;

function resize() {
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}

resize();
window.addEventListener("resize", resize);

const mouse = {
    x: -9999,
    y: -9999
};

window.addEventListener("mousemove", e => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
});

function draw() {

    ctx.clearRect(0, 0, w, h);

    ctx.fillStyle = "#020617";
    ctx.fillRect(0, 0, w, h);

    const horizon = h * 0.50;

    for (let z = 0; z < 45; z++) {

        const perspective = z / 45;

        const y =
            horizon +
            perspective * perspective * h;

        const wave =
            Math.sin(time + z * 0.25) * 15;

        ctx.beginPath();

        for (let x = -100; x <= w + 100; x += 20) {

            const distortion =
                Math.sin(x * 0.01 + time * 1.5 + z * 0.2) * 12;

            const finalY = y + distortion + wave;

            if (x === -100) {
                ctx.moveTo(x, finalY);
            } else {
                ctx.lineTo(x, finalY);
            }
        }

        const alpha = 0.08 + perspective * 0.4;

        ctx.strokeStyle = `rgba(0,255,255,${alpha})`;
        ctx.lineWidth = 1;
        ctx.stroke();
    }

    for (let x = 0; x < w; x += 40) {

        ctx.beginPath();

        for (let z = 0; z < 45; z++) {

            const perspective = z / 45;

            const y =
                horizon +
                perspective * perspective * h;

            const offset =
                Math.sin(time + z * 0.25) * 15;

            const distortion =
                Math.sin(x * 0.01 + time * 1.5 + z * 0.2) * 12;

            const px =
                x +
                Math.sin(time + z * 0.1) * 8;

            const py =
                y +
                distortion +
                offset;

            if (z === 0) {
                ctx.moveTo(px, py);
            } else {
                ctx.lineTo(px, py);
            }
        }

        ctx.strokeStyle = "rgba(0,180,255,0.15)";
        ctx.lineWidth = 1;
        ctx.stroke();
    }

    for (let i = 0; i < 120; i++) {

        const px =
            (i * 97 + time * 20) % w;

        const py =
            (i * 53) % horizon;

        const size =
            1 + Math.sin(time + i) * 0.5;

        ctx.beginPath();
        ctx.arc(px, py, size, 0, Math.PI * 2);
        ctx.fillStyle = "rgba(0,255,255,0.6)";
        ctx.fill();
    }

    const glow = ctx.createRadialGradient(
        mouse.x,
        mouse.y,
        0,
        mouse.x,
        mouse.y,
        250
    );

    glow.addColorStop(0, "rgba(0,255,255,0.12)");
    glow.addColorStop(1, "rgba(0,255,255,0)");

    ctx.fillStyle = glow;
    ctx.fillRect(0, 0, w, h);

    time += 0.015;

    requestAnimationFrame(draw);
}

draw();