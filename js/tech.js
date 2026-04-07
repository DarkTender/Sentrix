window.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('neural-canvas');
    if (!canvas) return;
  
    const ctx = canvas.getContext('2d');
  
    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;
  
    const resizeCanvas = () => {
      width = canvas.width = window.innerWidth;
      height = canvas.height = window.innerHeight;
      initNodes();
    };
    window.addEventListener('resize', resizeCanvas);
  
    // Konfigurácia farieb pre "Tech Hub"
    const bgColor = 'rgba(3, 7, 18, 0.9)';          // veľmi tmavá
    const nodeColor = '#38bdf8';                    // info modrá
    const nodeCoreColor = '#22c55e';                // zelený stred
    const linkColor = 'rgba(148, 163, 184, 0.35)';  // sivé linky
    const pulseColor = '#a855f7';                   // pulzujúca trasa (fialová)
  
    // Uzly v "mriežke" – aby to vyzeralo ako štruktúrovaná sieť, nie random šum
    const nodes = [];
    const baseCols = 10;
    const baseRows = 6;
  
    function initNodes() {
      nodes.length = 0;
      const cols = baseCols;
      const rows = baseRows;
      const xStep = width / (cols + 1);
      const yStep = height / (rows + 1);
  
      for (let y = 1; y <= rows; y++) {
        for (let x = 1; x <= cols; x++) {
          nodes.push({
            x: x * xStep + (Math.random() - 0.5) * 40,
            y: y * yStep + (Math.random() - 0.5) * 40,
            pulse: Math.random(),  // fázový posun pulzu
            level: Math.random(),  // "dôležitosť" uzla
          });
        }
      }
    }
  
    initNodes();
  
    // Náhodne generované "dátové trasy" – sekvencie indexov uzlov
    const routes = [];
    const maxRoutes = 4;
  
    function generateRoute() {
      if (nodes.length === 0) return;
  
      let current = Math.floor(Math.random() * nodes.length);
      const path = [current];
  
      const steps = 4 + Math.floor(Math.random() * 5);
  
      for (let i = 0; i < steps; i++) {
        const candidates = [];
        const currentNode = nodes[current];
  
        for (let j = 0; j < nodes.length; j++) {
          if (j === current) continue;
          const n = nodes[j];
          const dx = n.x - currentNode.x;
          const dy = n.y - currentNode.y;
          const dist = Math.sqrt(dx * dx + dy * dy);
  
          if (dist < Math.min(width, height) / 3) {
            candidates.push({ index: j, dist });
          }
        }
  
        if (!candidates.length) break;
  
        candidates.sort((a, b) => a.dist - b.dist);
        const next = candidates[Math.floor(Math.random() * Math.min(4, candidates.length))].index;
  
        if (path.includes(next)) break;
  
        path.push(next);
        current = next;
      }
  
      if (path.length > 2) {
        routes.push({
          path,
          progress: 0,
          speed: 0.005 + Math.random() * 0.01,
        });
      }
    }
  
    // Pridávaj trasy postupne
    setInterval(() => {
      if (routes.length < maxRoutes) {
        generateRoute();
      }
    }, 1000);
  
    const mouse = { x: null, y: null };
    window.addEventListener('mousemove', (e) => {
      mouse.x = e.clientX;
      mouse.y = e.clientY;
    });
  
    function drawNodes(time) {
      for (const n of nodes) {
        const baseRadius = 2.2 + n.level * 1.8;
        const pulse = (Math.sin(time * 0.003 + n.pulse * Math.PI * 2) + 1) / 2; // 0–1
        const rOuter = baseRadius + pulse * 2;
  
        // jemná žiara
        const gradient = ctx.createRadialGradient(n.x, n.y, 0, n.x, n.y, rOuter * 3);
        gradient.addColorStop(0, 'rgba(34,197,94,0.4)');
        gradient.addColorStop(1, 'rgba(3,7,18,0)');
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.arc(n.x, n.y, rOuter * 3, 0, Math.PI * 2);
        ctx.fill();
  
        // vonkajší kruh
        ctx.beginPath();
        ctx.arc(n.x, n.y, rOuter, 0, Math.PI * 2);
        ctx.strokeStyle = 'rgba(148, 163, 184, 0.6)';
        ctx.lineWidth = 1;
        ctx.stroke();
  
        // jadro
        ctx.beginPath();
        ctx.arc(n.x, n.y, baseRadius, 0, Math.PI * 2);
        ctx.fillStyle = nodeCoreColor;
        ctx.fill();
      }
    }
  
    function drawBaseLinks() {
      ctx.lineWidth = 1;
      for (let i = 0; i < nodes.length; i++) {
        for (let j = i + 1; j < nodes.length; j++) {
          const a = nodes[i];
          const b = nodes[j];
          const dx = a.x - b.x;
          const dy = a.y - b.y;
          const dist = Math.sqrt(dx * dx + dy * dy);
          if (dist < Math.min(width, height) / 5) {
            const alpha = 1 - dist / (Math.min(width, height) / 5);
            ctx.strokeStyle = `rgba(148, 163, 184, ${alpha * 0.4})`;
            ctx.beginPath();
            ctx.moveTo(a.x, a.y);
            ctx.lineTo(b.x, b.y);
            ctx.stroke();
          }
        }
      }
    }
  
    function drawRoutes() {
      ctx.lineWidth = 2;
  
      for (const route of routes) {
        const path = route.path;
        if (path.length < 2) continue;
  
        ctx.strokeStyle = pulseColor;
        ctx.beginPath();
        for (let i = 0; i < path.length - 1; i++) {
          const a = nodes[path[i]];
          const b = nodes[path[i + 1]];
          if (i === 0) ctx.moveTo(a.x, a.y);
          ctx.lineTo(b.x, b.y);
        }
        ctx.stroke();
  
        // "dátový pulz" bežiaci po trase
        const totalSegments = path.length - 1;
        const pos = route.progress * totalSegments;
        const segIndex = Math.floor(pos);
        const t = pos - segIndex;
  
        if (segIndex >= 0 && segIndex < totalSegments) {
          const a = nodes[path[segIndex]];
          const b = nodes[path[segIndex + 1]];
          const x = a.x + (b.x - a.x) * t;
          const y = a.y + (b.y - a.y) * t;
  
          const gradient = ctx.createRadialGradient(x, y, 0, x, y, 18);
          gradient.addColorStop(0, 'rgba(168,85,247,0.9)');
          gradient.addColorStop(1, 'rgba(3,7,18,0)');
  
          ctx.fillStyle = gradient;
          ctx.beginPath();
          ctx.arc(x, y, 14, 0, Math.PI * 2);
          ctx.fill();
        }
  
        route.progress += route.speed;
      }
  
      // odstraň trasy, ktoré dobehli
      for (let i = routes.length - 1; i >= 0; i--) {
        if (routes[i].progress >= 1) {
          routes.splice(i, 1);
        }
      }
    }
  
    function drawMouseEffect() {
      if (!mouse.x || !mouse.y) return;
  
      for (const n of nodes) {
        const dx = n.x - mouse.x;
        const dy = n.y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 140) {
          const alpha = 1 - dist / 140;
          ctx.strokeStyle = `rgba(56,189,248,${alpha})`;
          ctx.lineWidth = 1.2;
          ctx.beginPath();
          ctx.moveTo(n.x, n.y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.stroke();
        }
      }
    }
  
    function animate(time) {
      ctx.fillStyle = bgColor;
      ctx.fillRect(0, 0, width, height);
  
      drawBaseLinks();
      drawRoutes();
      drawNodes(time);
      drawMouseEffect();
  
      requestAnimationFrame(animate);
    }
  
    animate(0);
  });
  