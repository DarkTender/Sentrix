<?php include "parts/header.php"?>
  <main class="container py-5" id="tools">
    <!-- HERO -->
    <section class="tl-hero tl-surface rounded-5 p-4 p-lg-5 mb-4 shadow-lg">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-8">
          <div class="tl-kicker mb-3">
            <span class="tl-pill tl-pill-accent"><i class="fa-solid fa-toolbox me-2"></i>SENTRIX Arsenal</span>
            <span class="tl-pill tl-pill-muted"><i class="fa-solid fa-lock me-2"></i>authorized only</span>
            <span class="tl-pill tl-pill-muted"><i class="fa-solid fa-flag me-2"></i>CTF / homelab</span>
          </div>

          <h1 class="display-5 fw-bold text-light mb-3">
            Tools & Techniques
          </h1>

          <p class="lead fs-4 text-light-emphasis mb-0">
            Môj “arsenal board”: nástroje ktoré používam pri učení a labovaní. Ku každému toolu cieľ: vedieť kedy ho
            použiť, čo očakávať na výstupe a spraviť z toho writeup/poznámku.
          </p>
        </div>

        <div class="col-lg-4">
          <div class="tl-rules rounded-4 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div class="fw-bold text-light">Rules of engagement</div>
              <span class="tl-pill tl-pill-muted">ROE</span>
            </div>
            <ul class="tl-mini-list mb-0">
              <li><i class="fa-solid fa-scale-balanced"></i> Legálne & eticky</li>
              <li><i class="fa-solid fa-lock"></i> Iba autorizované ciele</li>
              <li><i class="fa-solid fa-clipboard"></i> Dokumentovať postup</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- FILTER -->
    <section class="tl-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3 mb-3">
        <div>
          <h2 class="tl-title text-light mb-1"><i class="fa-solid fa-filter text-info me-2"></i>Filter</h2>
          <p class="text-secondary mb-0">Klikni na kategóriu a zobrazí sa len príslušný set nástrojov.</p>
        </div>

        <div class="tl-chips" id="toolFilters" aria-label="Tool filters">
          <button class="tl-chip is-active" type="button" data-filter="all"><i class="fa-solid fa-layer-group"></i>All</button>
          <button class="tl-chip" type="button" data-filter="recon"><i class="fa-solid fa-satellite-dish"></i>Recon</button>
          <button class="tl-chip" type="button" data-filter="web"><i class="fa-solid fa-globe"></i>Web</button>
          <button class="tl-chip" type="button" data-filter="wireless"><i class="fa-solid fa-wifi"></i>Wireless</button>
          <button class="tl-chip" type="button" data-filter="passwords"><i class="fa-solid fa-key"></i>Passwords</button>
          <button class="tl-chip" type="button" data-filter="osint"><i class="fa-solid fa-magnifying-glass"></i>OSINT</button>
          <button class="tl-chip" type="button" data-filter="notes"><i class="fa-solid fa-file-pen"></i>Notes</button>
        </div>
      </div>

      <div class="tl-grid" id="toolGrid">
        <!-- Recon -->
        <article class="tl-card" data-category="recon notes">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-cyan"><i class="fa-solid fa-diagram-project"></i></div>
            <div>
              <h3 class="tl-card-title">nmap</h3>
              <p class="tl-card-desc">Recon a enumerácia služieb v lab prostredí. Základné “mapovanie povrchu”.</p>
            </div>
          </div>
          <div class="tl-tags">
            <span class="tl-tag">recon</span><span class="tl-tag">network</span><span class="tl-tag">notes</span>
          </div>
        </article>

        <article class="tl-card" data-category="recon">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-purple"><i class="fa-solid fa-bolt"></i></div>
            <div>
              <h3 class="tl-card-title">rustscan</h3>
              <p class="tl-card-desc">Rýchly port scan (potom potvrdenie cez nmap). Super na HTB/CTF flow.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">recon</span><span class="tl-tag">speed</span></div>
        </article>

        <article class="tl-card" data-category="recon web">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-green"><i class="fa-solid fa-binoculars"></i></div>
            <div>
              <h3 class="tl-card-title">whatweb</h3>
              <p class="tl-card-desc">Rýchla identifikácia web stacku (server, framework, CMS) v lab/test prostredí.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">recon</span><span class="tl-tag">web</span></div>
        </article>

        <!-- Web -->
        <article class="tl-card" data-category="web notes">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-cyan"><i class="fa-solid fa-spider"></i></div>
            <div>
              <h3 class="tl-card-title">Burp Suite / OWASP ZAP</h3>
              <p class="tl-card-desc">Proxy workflow: request/response, Repeater, intruder (lab), reporting.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">web</span><span class="tl-tag">proxy</span><span class="tl-tag">notes</span></div>
        </article>

        <article class="tl-card" data-category="web">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-purple"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
            <div>
              <h3 class="tl-card-title">ffuf</h3>
              <p class="tl-card-desc">Fuzzing ciest/parametrov v CTF a laboch. Objavovanie endpointov.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">web</span><span class="tl-tag">fuzz</span></div>
        </article>

        <article class="tl-card" data-category="web">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-green"><i class="fa-solid fa-folder-tree"></i></div>
            <div>
              <h3 class="tl-card-title">feroxbuster</h3>
              <p class="tl-card-desc">Content discovery (directories/files) v laboch. Rýchly “surface mapping”.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">web</span><span class="tl-tag">discovery</span></div>
        </article>

        <!-- Passwords (CTF only) -->
        <article class="tl-card tl-card-dark" data-category="passwords">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-red"><i class="fa-solid fa-key"></i></div>
            <div>
              <h3 class="tl-card-title">john / hashcat</h3>
              <p class="tl-card-desc">Password cracking na CTF dumpy a vlastné lab testy. (CTF/lab only)</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">passwords</span><span class="tl-tag">ctf</span></div>
        </article>

        <article class="tl-card tl-card-dark" data-category="passwords">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-red"><i class="fa-solid fa-box-archive"></i></div>
            <div>
              <h3 class="tl-card-title">SecLists</h3>
              <p class="tl-card-desc">Wordlists pre discovery a CTF scenáre. Dobrý základ pre fuzzing/dicts.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">passwords</span><span class="tl-tag">wordlists</span></div>
        </article>

        <!-- Wireless (lab only, high-level) -->
        <article class="tl-card" data-category="wireless notes">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-cyan"><i class="fa-solid fa-wifi"></i></div>
            <div>
              <h3 class="tl-card-title">aircrack-ng suite</h3>
              <p class="tl-card-desc">Wireless lab tooling: monitor mode, capture, analýza. (lab only)</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">wireless</span><span class="tl-tag">lab</span><span class="tl-tag">notes</span></div>
        </article>

        <article class="tl-card" data-category="wireless">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-purple"><i class="fa-solid fa-satellite"></i></div>
            <div>
              <h3 class="tl-card-title">bettercap</h3>
              <p class="tl-card-desc">Experimenty v izolovanom lab prostredí. (lab only)</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">wireless</span><span class="tl-tag">lab</span></div>
        </article>

        <!-- OSINT -->
        <article class="tl-card" data-category="osint notes">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-green"><i class="fa-solid fa-magnifying-glass"></i></div>
            <div>
              <h3 class="tl-card-title">theHarvester</h3>
              <p class="tl-card-desc">OSINT zber (výučbovo): čo sa dá nájsť verejne a ako to dokumentovať.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">osint</span><span class="tl-tag">notes</span></div>
        </article>

        <!-- Notes -->
        <article class="tl-card" data-category="notes">
          <div class="tl-card-top">
            <div class="tl-ico tl-ico-cyan"><i class="fa-solid fa-note-sticky"></i></div>
            <div>
              <h3 class="tl-card-title">Notes workflow</h3>
              <p class="tl-card-desc">Šablóna: Goal → Recon → Findings → Proof → Fix/lesson → Links.</p>
            </div>
          </div>
          <div class="tl-tags"><span class="tl-tag">notes</span><span class="tl-tag">writeups</span></div>
        </article>
      </div>

      <div class="tl-empty" id="toolEmpty" hidden>
        <div class="text-center p-4 rounded-4 tl-empty-box">
          <div class="display-6 fw-bold text-info mb-2"><i class="fa-solid fa-ghost me-2"></i>No matches</div>
          <p class="mb-0 text-light-emphasis">Skús iný filter alebo “All”.</p>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="text-center py-5 rounded-5 mb-3 shadow-lg tl-surface tl-cta">
      <div class="display-6 fw-bold text-info mb-3">
        <i class="fa-solid fa-book-skull me-2"></i>
        Z tools → do writeupu
      </div>
      <p class="fs-4 text-light mb-4">
        Cieľ: ku každému labu spraviť poznámky a premeniť ich na writeup.
      </p>
      <a href="writeups.html" class="btn btn-lg btn-info btn-glow px-5 py-3 fs-5 fw-bold">
        Prejsť na writeups
      </a>
    </section>
  </main>
  <?php include "parts/footer.php"?>


</html>