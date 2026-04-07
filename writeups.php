<?php include "parts/header.php"?>
  <main class="container py-5">
    <!-- Header -->
    <header class="writeups-hero rounded-5 p-5 mb-4 text-light shadow-lg">
      <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">
        <div>
          <h1 class="display-5 fw-bold mb-2">
            <i class="fa-solid fa-book-skull text-info me-3"></i>
            Writeups & Lab Notes
          </h1>
          <p class="lead opacity-90 mb-0">
            Praktické poznámky z učenia: web security, networking, logy/detekcie (iba legálne prostredia)
          </p>
        </div>

        <div class="d-flex flex-wrap gap-2">
          <a class="btn btn-info btn-glow" href="#zoznam">
            <i class="fa-solid fa-list me-2"></i>Zoznam
          </a>
          <a class="btn btn-outline-light" href="#kategorie">
            <i class="fa-solid fa-tags me-2"></i>Kategórie
          </a>
          <a class="btn btn-outline-light" href="#plan">
            <i class="fa-solid fa-diagram-project me-2"></i>Plán (PHP)
          </a>
        </div>
      </div>

      <hr class="border border-info border-opacity-25 my-4">

      <div class="row g-3 align-items-end">
        <div class="col-lg-7">
          <label for="search" class="form-label small text-light-emphasis mb-2">Rýchle vyhľadávanie</label>
          <div class="input-group input-group-lg">
            <span class="input-group-text bg-dark bg-opacity-50 border-info text-info">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input id="search" type="search" class="form-control bg-dark bg-opacity-50 border-info text-light"
              placeholder="napr. XSS, Wireshark, SIEM, Nmap..." autocomplete="off">
          </div>
        </div>

        <div class="col-lg-5">
          <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
            <button class="btn btn-outline-info" type="button" data-filter="all">
              <i class="fa-solid fa-layer-group me-2"></i>Všetko
            </button>
            <button class="btn btn-outline-info" type="button" data-filter="web">Web</button>
            <button class="btn btn-outline-info" type="button" data-filter="net">Network</button>
            <button class="btn btn-outline-info" type="button" data-filter="det">Detection</button>
            <button class="btn btn-outline-info" type="button" data-filter="hard">Hardening</button>
          </div>
          <p class="small text-light-emphasis mt-2 mb-0 text-lg-end">
            Tip: toto je zatiaľ statická demo verzia – neskôr sa nahradí DB + CRUD.
          </p>
        </div>
      </div>
    </header>

    <!-- Quick disclaimer / purpose -->
    <section class="writeups-note rounded-5 p-4 mb-5 border border-info border-opacity-25 bg-dark bg-opacity-50">
      <div class="row g-3 align-items-center">
        <div class="col-md-auto">
          <div class="writeups-note-icon">
            <i class="fa-solid fa-triangle-exclamation text-warning"></i>
          </div>
        </div>
        <div class="col">
          <h2 class="h5 fw-bold mb-1 text-light">Bezpečnostná poznámka</h2>
          <p class="mb-0 text-light-emphasis">
            Všetky postupy sú určené výhradne na <strong>legálne/autorizované</strong> prostredia (homelab, CTF,
            testovacie VM). Žiadne reálne ciele.
          </p>
        </div>
      </div>
    </section>

    <!-- List (static demo cards) -->
    <section id="zoznam" class="mb-5">
      <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3 mb-4">
        <div>
          <h2 class="fs-2 fw-bold text-light mb-1">
            <i class="fa-solid fa-list-check text-info me-2"></i>Writeups (preview)
          </h2>
          <p class="text-light-emphasis mb-0">Karty sú demo – neskôr to bude dynamický zoznam z databázy.</p>
        </div>

        <div class="small text-light-emphasis">
          Zobrazené: <span id="resultCount" class="text-info fw-bold">0</span>
        </div>
      </div>

      <div class="row g-4" id="writeupGrid">
        <!-- Example items (static) -->
        <div class="col-md-6 col-xl-4 writeup-item" data-category="web" data-tags="xss owasp dom sanitization">
          <article class="writeup-card h-100 rounded-5 p-4">
            <div class="d-flex align-items-start justify-content-between gap-3">
              <div>
                <div class="badge text-bg-info mb-2"><i class="fa-solid fa-globe me-1"></i>Web</div>
                <h3 class="h5 fw-bold text-light mb-2">Lab: Reflected XSS – payloady & obrana</h3>
              </div>
              <div class="text-info opacity-75"><i class="fa-solid fa-bug"></i></div>
            </div>
            <p class="text-light-emphasis mb-3">
              Krátke poznámky k testovaniu reflected XSS v lab aplikácii + čo kontrolovať (encoding, CSP, input
              validation).
            </p>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="tag">OWASP</span><span class="tag">XSS</span><span class="tag">CSP</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-light-emphasis"><i class="fa-regular fa-calendar me-1"></i>2026-03-03</small>
              <a class="btn btn-sm btn-outline-info disabled" aria-disabled="true" href="#">
                Detail (neskôr)
              </a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4 writeup-item" data-category="web" data-tags="sqli pdo prepared statements injection">
          <article class="writeup-card h-100 rounded-5 p-4">
            <div class="d-flex align-items-start justify-content-between gap-3">
              <div>
                <div class="badge text-bg-info mb-2"><i class="fa-solid fa-globe me-1"></i>Web</div>
                <h3 class="h5 fw-bold text-light mb-2">Poznámky: SQLi → PDO prepared statements</h3>
              </div>
              <div class="text-info opacity-75"><i class="fa-solid fa-database"></i></div>
            </div>
            <p class="text-light-emphasis mb-3">
              Zhrnutie typov SQL injection + ako to neskôr spravíš bezpečne v PHP 8 cez PDO a bind parametre.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="tag">SQLi</span><span class="tag">PDO</span><span class="tag">PHP</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-light-emphasis"><i class="fa-regular fa-calendar me-1"></i>2026-03-03</small>
              <a class="btn btn-sm btn-outline-info disabled" aria-disabled="true" href="#">Detail (neskôr)</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4 writeup-item" data-category="net" data-tags="wireshark dns http tls pcap">
          <article class="writeup-card h-100 rounded-5 p-4">
            <div class="d-flex align-items-start justify-content-between gap-3">
              <div>
                <div class="badge text-bg-primary mb-2"><i class="fa-solid fa-network-wired me-1"></i>Network</div>
                <h3 class="h5 fw-bold text-light mb-2">PCAP: DNS/HTTP/TLS triage vo Wiresharku</h3>
              </div>
              <div class="text-primary opacity-75"><i class="fa-solid fa-wave-square"></i></div>
            </div>
            <p class="text-light-emphasis mb-3">
              Check-list: čo si pozrieť ako prvé, filtre, IO graph, follow stream a rýchle zistenia.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="tag">PCAP</span><span class="tag">DNS</span><span class="tag">TLS</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-light-emphasis"><i class="fa-regular fa-calendar me-1"></i>2026-03-03</small>
              <a class="btn btn-sm btn-outline-primary disabled" aria-disabled="true" href="#">Detail (neskôr)</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4 writeup-item" data-category="det" data-tags="siem logs detection triage sigma">
          <article class="writeup-card h-100 rounded-5 p-4">
            <div class="d-flex align-items-start justify-content-between gap-3">
              <div>
                <div class="badge text-bg-warning mb-2"><i class="fa-solid fa-eye me-1"></i>Detection</div>
                <h3 class="h5 fw-bold text-light mb-2">Mini: logy → alert → triage (framework)</h3>
              </div>
              <div class="text-warning opacity-75"><i class="fa-solid fa-bell"></i></div>
            </div>
            <p class="text-light-emphasis mb-3">
              Ako si udržať poriadok v lab detekciách: zdroj, signál, false positives, enrichment, poznámky.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="tag">Logs</span><span class="tag">Triage</span><span class="tag">Sigma</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-light-emphasis"><i class="fa-regular fa-calendar me-1"></i>2026-03-03</small>
              <a class="btn btn-sm btn-outline-warning disabled" aria-disabled="true" href="#">Detail (neskôr)</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4 writeup-item" data-category="hard" data-tags="linux hardening ssh firewall baseline">
          <article class="writeup-card h-100 rounded-5 p-4">
            <div class="d-flex align-items-start justify-content-between gap-3">
              <div>
                <div class="badge text-bg-success mb-2"><i class="fa-solid fa-lock me-1"></i>Hardening</div>
                <h3 class="h5 fw-bold text-light mb-2">Linux baseline: SSH, updates, firewall</h3>
              </div>
              <div class="text-success opacity-75"><i class="fa-solid fa-shield"></i></div>
            </div>
            <p class="text-light-emphasis mb-3">
              Rýchly baseline pre lab VM: SSH config, usery, unattended-upgrades, ufw/iptables, audit logy.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="tag">Linux</span><span class="tag">SSH</span><span class="tag">Firewall</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-light-emphasis"><i class="fa-regular fa-calendar me-1"></i>2026-03-03</small>
              <a class="btn btn-sm btn-outline-success disabled" aria-disabled="true" href="#">Detail (neskôr)</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4 writeup-item" data-category="net" data-tags="nmap scanning enumeration">
          <article class="writeup-card h-100 rounded-5 p-4">
            <div class="d-flex align-items-start justify-content-between gap-3">
              <div>
                <div class="badge text-bg-primary mb-2"><i class="fa-solid fa-network-wired me-1"></i>Network</div>
                <h3 class="h5 fw-bold text-light mb-2">Nmap cheatsheet (lab)</h3>
              </div>
              <div class="text-primary opacity-75"><i class="fa-solid fa-radar"></i></div>
            </div>
            <p class="text-light-emphasis mb-3">
              Najčastejšie príkazy a prepínače – discovery, service detection, scripts, output formáty.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="tag">Nmap</span><span class="tag">Scan</span><span class="tag">Enum</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-light-emphasis"><i class="fa-regular fa-calendar me-1"></i>2026-03-03</small>
              <a class="btn btn-sm btn-outline-primary disabled" aria-disabled="true" href="#">Detail (neskôr)</a>
            </div>
          </article>
        </div>
      </div>

      <div id="noResults" class="text-center py-5 d-none">
        <div class="display-6 fw-bold text-light mb-2">Nič sa nenašlo</div>
        <p class="text-light-emphasis mb-4">Skús zmeniť kľúčové slovo alebo filter kategórie.</p>
        <button class="btn btn-outline-info" type="button" id="resetBtn">
          <i class="fa-solid fa-rotate-left me-2"></i>Reset
        </button>
      </div>
    </section>

    <!-- Categories overview -->
    <section class="mb-5" id="kategorie">
      <h2 class="fs-2 fw-bold text-center mb-4 text-light">
        <i class="fa-solid fa-tags text-info me-2"></i>Kategórie
      </h2>

      <div class="row justify-content-center gy-4">
        <div class="col-lg-3 col-md-6">
          <div class="category-card h-100 rounded-5 p-4">
            <div class="category-icon text-info"><i class="fa-solid fa-globe"></i></div>
            <div class="fw-bold fs-5 text-light mt-2">Web Security</div>
            <div class="small text-light-emphasis">OWASP, input handling, auth, sessions, secure coding.</div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="category-card h-100 rounded-5 p-4">
            <div class="category-icon text-primary"><i class="fa-solid fa-network-wired"></i></div>
            <div class="fw-bold fs-5 text-light mt-2">Networking</div>
            <div class="small text-light-emphasis">PCAP, protokoly, scanning, segmentácia, DNS/TLS.</div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="category-card h-100 rounded-5 p-4">
            <div class="category-icon text-warning"><i class="fa-solid fa-eye"></i></div>
            <div class="fw-bold fs-5 text-light mt-2">Detection</div>
            <div class="small text-light-emphasis">Logy, alerty, triage, korelácie, Sigma.</div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="category-card h-100 rounded-5 p-4">
            <div class="category-icon text-success"><i class="fa-solid fa-lock"></i></div>
            <div class="fw-bold fs-5 text-light mt-2">Hardening</div>
            <div class="small text-light-emphasis">Linux baseline, služby, konfigurácie, firewall, patching.</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Future plan / CTA -->
    <section id="plan" class="writeups-cta text-center py-5 rounded-5 border border-info border-opacity-25 mb-5">
      <div class="display-6 fw-bold text-info mb-3">
        <i class="fa-solid fa-code-branch me-2"></i>Kam to smeruje (PHP verzia)
      </div>
      <p class="fs-5 text-light mb-4">
        Táto stránka bude neskôr napojená na databázu: <strong>Articles/Writeups</strong> + CRUD + tagy + vyhľadávanie.
        Editácia/mazanie len po prihlásení (sessions).
      </p>
      <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
        <a href="roadmap.html" class="btn btn-info btn-glow btn-lg">
          <i class="fa-solid fa-map me-2"></i>Pozrieť roadmap
        </a>
        <a href="login.html" class="btn btn-outline-light btn-lg">
          <i class="fa-solid fa-right-to-bracket me-2"></i>Login (demo)
        </a>
      </div>
    </section>

    <!-- Footer nav -->
    <section class="text-center pb-4">
      <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
        <a href="index.html" class="btn btn-outline-light btn-lg">
          <i class="fa-solid fa-house me-2"></i>Späť na domov
        </a>
        <a href="community.html" class="btn btn-light btn-lg">
          <i class="fa-solid fa-users me-2"></i>Komunita
        </a>
      </div>
    </section>
  </main>
  <?php include "parts/footer.php"?>


</html>
