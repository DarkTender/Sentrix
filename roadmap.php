<?php include "parts/header.php"?>
  <main class="container py-5" id="roadmap">
    <!-- HERO -->
    <section class="rm-hero rm-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-8">
          <div class="rm-kicker mb-2">
            <span class="rm-pill"><i class="fa-solid fa-compass me-2"></i>Learning roadmap</span>
            <span class="rm-pill rm-pill-muted"><i class="fa-solid fa-flask-vial me-2"></i>Labs / CTF</span>
            <span class="rm-pill rm-pill-muted"><i class="fa-solid fa-code me-2"></i>Java • PHP • Python</span>
          </div>

          <h1 class="display-5 fw-bold text-light mb-3">
            Roadmap učenia — SENTRIX
          </h1>

          <p class="lead text-light-emphasis mb-0">
            Toto je môj “dashboard”, kde si držím smer: aké cyber zručnosti sa učím, kde robím laby,
            a aké programovanie k tomu budujem. Všetko iba v legálnych/autorizovaných prostrediach.
          </p>
        </div>

        <div class="col-lg-4">
          <div class="rm-stats rounded-4 p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="text-light fw-bold">Focus (aktuálne)</div>
              <span class="rm-pill rm-pill-accent"><i class="fa-solid fa-bolt me-2"></i>NOW</span>
            </div>

            <ul class="rm-mini-list mb-0">
              <li><i class="fa-solid fa-terminal"></i> OverTheWire / základy Linux</li>
              <li><i class="fa-solid fa-flag-checkered"></i> CTF (web + basics)</li>
              <li><i class="fa-solid fa-network-wired"></i> Networking & traffic</li>
              <li><i class="fa-solid fa-code"></i> Python automations</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- TRACKS -->
    <section class="mb-5">
      <div class="d-flex align-items-end justify-content-between gap-3 mb-3">
        <div>
          <h2 class="rm-title text-light mb-1"><i class="fa-solid fa-layer-group text-info me-2"></i>Learning tracks</h2>
          <p class="text-secondary mb-0">Rozdelené do “stôp” — aby som vedel, čo presne trénujem.</p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <article class="rm-card rm-surface rounded-5 p-4 h-100">
            <div class="rm-card-head">
              <div class="rm-ico rm-ico-cyan"><i class="fa-solid fa-globe"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Web security</h3>
                <p class="text-light-emphasis small mb-0">OWASP, burp workflow, chyby, fixy, writeups.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="rm-tag">XSS</span><span class="rm-tag">SQLi</span><span class="rm-tag">Auth</span><span
                class="rm-tag">Sessions</span>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <article class="rm-card rm-surface rounded-5 p-4 h-100">
            <div class="rm-card-head">
              <div class="rm-ico rm-ico-purple"><i class="fa-solid fa-network-wired"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Networking & analysis</h3>
                <p class="text-light-emphasis small mb-0">PCAP, DNS/HTTP/TLS, scanning, segmentácia.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="rm-tag">Wireshark</span><span class="rm-tag">DNS</span><span class="rm-tag">HTTP</span><span
                class="rm-tag">TLS</span>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <article class="rm-card rm-surface rounded-5 p-4 h-100">
            <div class="rm-card-head">
              <div class="rm-ico rm-ico-green"><i class="fa-solid fa-eye"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Detection & logs</h3>
                <p class="text-light-emphasis small mb-0">Logy, alerty, triage, jednoduché pravidlá.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="rm-tag">Triage</span><span class="rm-tag">Correlations</span><span
                class="rm-tag">Dashboards</span><span class="rm-tag">Baselines</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- PLATFORMS -->
    <section class="mb-5">
      <div class="rm-surface rounded-5 p-4 p-lg-5 shadow-lg">
        <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3 mb-4">
          <div>
            <h2 class="rm-title text-light mb-1"><i class="fa-solid fa-satellite-dish text-info me-2"></i>Platformy &
              laby</h2>
            <p class="text-secondary mb-0">Kde reálne trénujem (a z čoho budú writeups).</p>
          </div>
          <div class="d-flex flex-wrap gap-2">
            <span class="rm-pill rm-pill-muted"><i class="fa-solid fa-lock me-2"></i>authorized only</span>
            <span class="rm-pill rm-pill-muted"><i class="fa-solid fa-file-pen me-2"></i>writeups</span>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-6 col-lg-3">
            <div class="rm-platform rounded-4 p-4 h-100">
              <div class="rm-platform-top">
                <i class="fa-solid fa-terminal text-info"></i>
                <h3 class="h6 fw-bold text-light mb-0">OverTheWire</h3>
              </div>
              <p class="small text-light-emphasis mb-0">Linux, shell, základy postupov a disciplína.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="rm-platform rounded-4 p-4 h-100">
              <div class="rm-platform-top">
                <i class="fa-solid fa-cube text-primary"></i>
                <h3 class="h6 fw-bold text-light mb-0">Hack The Box</h3>
              </div>
              <p class="small text-light-emphasis mb-0">Boxes, labs, reťazenie poznatkov do praxe.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="rm-platform rounded-4 p-4 h-100">
              <div class="rm-platform-top">
                <i class="fa-solid fa-flag text-warning"></i>
                <h3 class="h6 fw-bold text-light mb-0">CTF</h3>
              </div>
              <p class="small text-light-emphasis mb-0">Web challs, crypto basics, forensics intro.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="rm-platform rounded-4 p-4 h-100">
              <div class="rm-platform-top">
                <i class="fa-solid fa-flask-vial text-success"></i>
                <h3 class="h6 fw-bold text-light mb-0">Vlastný lab</h3>
              </div>
              <p class="small text-light-emphasis mb-0">Kontrolované prostredie, logy, simulácie.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- LANGUAGES -->
    <section class="mb-5">
      <h2 class="rm-title text-light mb-3"><i class="fa-solid fa-code text-info me-2"></i>Programovanie popri cyber</h2>

      <div class="row g-4">
        <div class="col-lg-4">
          <div class="rm-card rm-surface rounded-5 p-4 h-100">
            <div class="rm-card-head">
              <div class="rm-ico rm-ico-cyan"><i class="fa-brands fa-python"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Python</h3>
                <p class="text-light-emphasis small mb-0">Automatizácie, parsovanie logov, malé tooly.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="rm-tag">requests</span><span class="rm-tag">regex</span><span
                class="rm-tag">parsing</span><span class="rm-tag">CLI</span>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="rm-card rm-surface rounded-5 p-4 h-100">
            <div class="rm-card-head">
              <div class="rm-ico rm-ico-purple"><i class="fa-brands fa-php"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">PHP</h3>
                <p class="text-light-emphasis small mb-0">Web backend základy, formuláre, bezpečné vzory.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="rm-tag">sessions</span><span class="rm-tag">input handling</span><span
                class="rm-tag">security</span>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="rm-card rm-surface rounded-5 p-4 h-100">
            <div class="rm-card-head">
              <div class="rm-ico rm-ico-green"><i class="fa-brands fa-java"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Java</h3>
                <p class="text-light-emphasis small mb-0">Základy, OOP, mini utilitky a logika.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="rm-tag">OOP</span><span class="rm-tag">basics</span><span class="rm-tag">small tools</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- NOW / NEXT / LATER -->
    <section class="mb-5">
      <div class="d-flex align-items-end justify-content-between gap-3 mb-3">
        <div>
          <h2 class="rm-title text-light mb-1"><i class="fa-solid fa-list-check text-info me-2"></i>Now / Next / Later
          </h2>
          <p class="text-secondary mb-0">Jednoduché rozdelenie, čo riešim a čo príde.</p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <section class="rm-column rm-surface rounded-5 p-4 h-100">
            <header class="rm-column-head">
              <h3 class="h5 fw-bold text-info mb-0"><i class="fa-solid fa-bolt me-2"></i>NOW</h3>
              <span class="rm-pill rm-pill-accent">aktuálne</span>
            </header>

            <div class="vstack gap-3 mt-3">
              <article class="rm-item">
                <div class="rm-item-title">OverTheWire + Linux rutina</div>
                <div class="rm-item-meta"><span class="rm-tag">terminal</span><span class="rm-tag">linux</span></div>
              </article>

              <article class="rm-item">
                <div class="rm-item-title">CTF web challenge (notes → writeup)</div>
                <div class="rm-item-meta"><span class="rm-tag">web</span><span class="rm-tag">writeups</span></div>
              </article>

              <article class="rm-item">
                <div class="rm-item-title">Python mini tool (parsing / automation)</div>
                <div class="rm-item-meta"><span class="rm-tag">python</span><span class="rm-tag">tools</span></div>
              </article>
            </div>
          </section>
        </div>

        <div class="col-lg-4">
          <section class="rm-column rm-surface rounded-5 p-4 h-100">
            <header class="rm-column-head">
              <h3 class="h5 fw-bold text-primary mb-0"><i class="fa-solid fa-forward me-2"></i>NEXT</h3>
              <span class="rm-pill rm-pill-muted">nasleduje</span>
            </header>

            <div class="vstack gap-3 mt-3">
              <article class="rm-item">
                <div class="rm-item-title">HackTheBox: 1 box / týždeň</div>
                <div class="rm-item-meta"><span class="rm-tag">htb</span><span class="rm-tag">labs</span></div>
              </article>

              <article class="rm-item">
                <div class="rm-item-title">Networking: PCAP analýza (DNS/HTTP/TLS)</div>
                <div class="rm-item-meta"><span class="rm-tag">pcap</span><span class="rm-tag">wireshark</span></div>
              </article>

              <article class="rm-item">
                <div class="rm-item-title">PHP/Java basics: malé projekty na rutinu</div>
                <div class="rm-item-meta"><span class="rm-tag">php</span><span class="rm-tag">java</span></div>
              </article>
            </div>
          </section>
        </div>

        <div class="col-lg-4">
          <section class="rm-column rm-surface rounded-5 p-4 h-100">
            <header class="rm-column-head">
              <h3 class="h5 fw-bold text-success mb-0"><i class="fa-solid fa-hourglass-half me-2"></i>LATER</h3>
              <span class="rm-pill rm-pill-muted">neskôr</span>
            </header>

            <div class="vstack gap-3 mt-3">
              <article class="rm-item">
                <div class="rm-item-title">Vlastný lab: logging + “attack simulation”</div>
                <div class="rm-item-meta"><span class="rm-tag">homelab</span><span class="rm-tag">logs</span></div>
              </article>

              <article class="rm-item">
                <div class="rm-item-title">Detection: jednoduché pravidlá + triage checklisty</div>
                <div class="rm-item-meta"><span class="rm-tag">detection</span><span class="rm-tag">triage</span></div>
              </article>

              <article class="rm-item">
                <div class="rm-item-title">Hardening: baseline pre Linux služby</div>
                <div class="rm-item-meta"><span class="rm-tag">hardening</span><span class="rm-tag">linux</span></div>
              </article>
            </div>
          </section>
        </div>
      </div>
    </section>

    <!-- WEEKLY ROUTINE -->
    <section class="rm-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <h2 class="rm-title text-light mb-3"><i class="fa-solid fa-calendar-week text-info me-2"></i>Týždenná rutina (template)
      </h2>

      <div class="row g-3">
        <div class="col-md-6 col-lg-3">
          <div class="rm-routine rounded-4 p-4 h-100">
            <div class="rm-routine-title">2× CTF</div>
            <div class="rm-routine-desc">Web challs + poznámky, čo som sa naučil.</div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="rm-routine rounded-4 p-4 h-100">
            <div class="rm-routine-title">1× HTB</div>
            <div class="rm-routine-desc">Box + debrief (čo fungovalo, čo nie).</div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="rm-routine rounded-4 p-4 h-100">
            <div class="rm-routine-title">2× OverTheWire</div>
            <div class="rm-routine-desc">Linux discipline + shell skills.</div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="rm-routine rounded-4 p-4 h-100">
            <div class="rm-routine-title">1× Programovanie</div>
            <div class="rm-routine-desc">Python tool / PHP basics / Java OOP.</div>
          </div>
        </div>
      </div>

      <p class="text-secondary small mt-3 mb-0">
        Tip: ku každej aktivite si daj “1 vetu výstupu” → potom sa to ľahko mení na writeup.
      </p>
    </section>

    <!-- CTA -->
    <section class="rm-cta text-center py-5 rounded-5 mb-5 shadow-lg">
      <div class="display-6 fw-bold text-info mb-3">
        <i class="fa-solid fa-book-skull me-2"></i>
        Chceš vidieť výsledky?
      </div>
      <p class="fs-4 text-light mb-4">
        Writeups sú miesto, kde z roadmapu vznikne reálny obsah (postupy, poznámky, lab výsledky).
      </p>
      <a href="writeups.html" class="btn btn-lg btn-info btn-glow px-5 py-3 fs-5 fw-bold">
        Prejsť na writeups
      </a>
    </section>

    <section id="kontakt" class="text-center mb-3">
      <h2 class="fs-2 fw-bold mb-3 text-light">Poznámka</h2>
      <p class="lead text-light-emphasis mb-4">
        Všetko je určené iba pre legálne/autorizované prostredia (homelab, CTF, platformy).
      </p>
      <a href="index.html" class="btn btn-outline-light btn-lg">
        <i class="fa-solid fa-house me-2"></i>Späť na domov
      </a>
    </section>
  </main>
  <?php include "parts/footer.php"?>


</html>