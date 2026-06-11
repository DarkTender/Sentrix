const canvas = document.getElementById("hero-bg");
const ctx = canvas.getContext("2d");

let w,h;

function resize(){
    w = canvas.width = window.innerWidth;
    h = canvas.height = window.innerHeight;
}

resize();
window.addEventListener("resize", resize);

const particles = [];

for(let i=0;i<120;i++){

    particles.push({
        x:Math.random()*w,
        y:Math.random()*h,
        vx:(Math.random()-0.5)*0.25,
        vy:(Math.random()-0.5)*0.25,
        size:Math.random()*2+1
    });
}

function animate(){

    ctx.clearRect(0,0,w,h);

    for(const p of particles){

        p.x += p.vx;
        p.y += p.vy;

        if(p.x<0) p.x=w;
        if(p.x>w) p.x=0;

        if(p.y<0) p.y=h;
        if(p.y>h) p.y=0;

        ctx.beginPath();
        ctx.arc(p.x,p.y,p.size,0,Math.PI*2);
        ctx.fillStyle="rgba(56,189,248,0.8)";
        ctx.fill();
    }

    for(let i=0;i<particles.length;i++){

        for(let j=i+1;j<particles.length;j++){

            const dx = particles[i].x-particles[j].x;
            const dy = particles[i].y-particles[j].y;

            const dist = Math.sqrt(dx*dx+dy*dy);

            if(dist<140){

                ctx.beginPath();
                ctx.moveTo(
                    particles[i].x,
                    particles[i].y
                );

                ctx.lineTo(
                    particles[j].x,
                    particles[j].y
                );

                ctx.strokeStyle =
                    `rgba(56,189,248,${
                        (140-dist)/140*0.15
                    })`;

                ctx.stroke();
            }
        }
    }

    requestAnimationFrame(animate);
}

animate();