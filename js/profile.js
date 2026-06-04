const canvas = document.getElementById("neuralCore");
const ctx = canvas.getContext("2d");

let w,h;
let time = 0;

function resize(){
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}

resize();
window.addEventListener("resize", resize);

const mouse = {
    x: -1000,
    y: -1000
};

window.addEventListener("mousemove", e => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
});

const nodes = [];

const totalNodes = 35;

for(let i=0;i<totalNodes;i++){

    const angle =
        (Math.PI * 2 / totalNodes) * i;

    const radius =
        250 + Math.random()*250;

    nodes.push({
        baseAngle: angle,
        radius: radius,
        speed: 0.0005 + Math.random()*0.001,
        size: 2 + Math.random()*3
    });
}

function draw(){

    ctx.clearRect(0,0,w,h);

    const cx = w/2;
    const cy = h/2;

    const glow = ctx.createRadialGradient(
        cx,cy,0,
        cx,cy,350
    );

    glow.addColorStop(0,"rgba(0,229,255,0.08)");
    glow.addColorStop(1,"rgba(0,229,255,0)");

    ctx.fillStyle = glow;
    ctx.fillRect(0,0,w,h);

    const positions = [];

    for(const node of nodes){

        const angle =
            node.baseAngle +
            performance.now() * node.speed;

        let x =
            cx +
            Math.cos(angle) * node.radius;

        let y =
            cy +
            Math.sin(angle) * node.radius;

        const dx = x - mouse.x;
        const dy = y - mouse.y;

        const dist =
            Math.sqrt(dx*dx + dy*dy);

        if(dist < 150){

            const force =
                (150-dist)/150;

            x += (dx/dist)*40*force;
            y += (dy/dist)*40*force;
        }

        positions.push({x,y,size:node.size});
    }

    for(let i=0;i<positions.length;i++){

        for(let j=i+1;j<positions.length;j++){

            const dx =
                positions[i].x -
                positions[j].x;

            const dy =
                positions[i].y -
                positions[j].y;

            const dist =
                Math.sqrt(dx*dx + dy*dy);

            if(dist < 220){

                const alpha =
                    (220-dist)/220*0.15;

                ctx.beginPath();
                ctx.moveTo(
                    positions[i].x,
                    positions[i].y
                );

                ctx.lineTo(
                    positions[j].x,
                    positions[j].y
                );

                ctx.strokeStyle =
                    `rgba(0,229,255,${alpha})`;

                ctx.stroke();
            }
        }
    }

    const pulseTime =
        performance.now()*0.001;

    for(let i=0;i<positions.length;i++){

        const node = positions[i];

        ctx.beginPath();
        ctx.arc(
            node.x,
            node.y,
            node.size,
            0,
            Math.PI*2
        );

        ctx.fillStyle="#00e5ff";
        ctx.shadowBlur=20;
        ctx.shadowColor="#00e5ff";
        ctx.fill();

        const pulse =
            (pulseTime + i*0.3)%1;

        const px =
            cx + (node.x-cx)*pulse;

        const py =
            cy + (node.y-cy)*pulse;

        ctx.beginPath();
        ctx.arc(px,py,2,0,Math.PI*2);

        ctx.fillStyle="#ffffff";
        ctx.fill();
    }

    ctx.shadowBlur=50;

    ctx.beginPath();
    ctx.arc(cx,cy,12,0,Math.PI*2);

    ctx.fillStyle="#00e5ff";
    ctx.fill();

    ctx.shadowBlur=0;

    ctx.beginPath();
    ctx.arc(
        cx,
        cy,
        180 + Math.sin(time)*10,
        0,
        Math.PI*2
    );

    ctx.strokeStyle=
        "rgba(0,229,255,0.12)";

    ctx.lineWidth=2;
    ctx.stroke();

    time += 0.01;

    requestAnimationFrame(draw);
}

draw();