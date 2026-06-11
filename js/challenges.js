const canvas = document.getElementById("radar-bg");
const ctx = canvas.getContext("2d");

let w,h;
let angle = 0;

const targets = [];

function resize(){
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}

resize();
window.addEventListener("resize", resize);

for(let i=0;i<25;i++){

    const radius = Math.random()*350;

    const a = Math.random()*Math.PI*2;

    targets.push({
        x: Math.cos(a)*radius,
        y: Math.sin(a)*radius,
        blink: Math.random()*100
    });
}

function draw(){

    ctx.clearRect(0,0,w,h);

    const cx = w / 2;
    const cy = h * 0.65;

    for(let r=100;r<=500;r+=100){

        ctx.beginPath();
        ctx.arc(cx,cy,r,0,Math.PI*2);

        ctx.strokeStyle="rgba(0,255,255,0.08)";
        ctx.lineWidth=1;
        ctx.stroke();
    }

    ctx.beginPath();
    ctx.moveTo(cx-500,cy);
    ctx.lineTo(cx+500,cy);

    ctx.moveTo(cx,cy-500);
    ctx.lineTo(cx,cy+500);

    ctx.strokeStyle="rgba(0,255,255,0.08)";
    ctx.stroke();

    const sweep = ctx.createRadialGradient(
        cx,cy,0,
        cx,cy,500
    );

    sweep.addColorStop(0,"rgba(0,255,255,0.25)");
    sweep.addColorStop(1,"rgba(0,255,255,0)");

    ctx.beginPath();
    ctx.moveTo(cx,cy);

    ctx.arc(
        cx,
        cy,
        500,
        angle,
        angle + 0.4
    );

    ctx.closePath();

    ctx.fillStyle = sweep;
    ctx.fill();

    for(const t of targets){

        const px = cx + t.x;
        const py = cy + t.y;

        const pulse =
            (Math.sin(Date.now()*0.003+t.blink)+1)/2;

        ctx.beginPath();
        ctx.arc(px,py,2+pulse*2,0,Math.PI*2);

        ctx.fillStyle =
            `rgba(0,255,255,${0.2+pulse*0.8})`;

        ctx.fill();
    }

    ctx.beginPath();
    ctx.arc(cx,cy,6,0,Math.PI*2);

    ctx.fillStyle="#00ffff";
    ctx.shadowBlur=25;
    ctx.shadowColor="#00ffff";
    ctx.fill();

    ctx.shadowBlur=0;

    angle += 0.008;

    requestAnimationFrame(draw);
}

draw();