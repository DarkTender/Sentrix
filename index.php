<?php include "parts/header.php"?>
  <main class="container py-5" id="home">
    <!-- HERO -->
    <section class="ix-hero ix-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-7">
          <div class="ix-kicker mb-3">
            <span class="ix-pill"><i class="fa-solid fa-compass me-2"></i>Cyber Learning Hub</span>
            <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-terminal me-2"></i>Linux</span>
            <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-wifi me-2"></i>Wireless</span>
            <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-microchip me-2"></i>Raspberry Pi</span>
          </div>

          <h1 class="display-4 fw-bold text-light mb-3">
            SENTRIX™
          </h1>

          <p class="lead fs-4 text-light-emphasis mb-4">
            Miesto, kde si budujem skillset a zdieľam poznámky: writeups, laby, nástroje a komunita
            zameraná na praktickú cyber bezpečnosť.
          </p>

          <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-lg btn-primary px-4 py-3 fw-bold ix-btn-glow" href="writeups.html">
              <i class="fa-solid fa-book-skull me-2"></i>Začať s writeups
            </a>
            <a class="btn btn-lg btn-outline-light px-4 py-3 fw-bold" href="roadmap.html">
              <i class="fa-solid fa-route me-2"></i>Pozrieť roadmap
            </a>
            <a class="btn btn-lg btn-outline-info px-4 py-3 fw-bold" href="tools.html">
              <i class="fa-solid fa-screwdriver-wrench me-2"></i>Tools
            </a>
          </div>

          <p class="small text-secondary mt-3 mb-0">
            <i class="fa-solid fa-shield me-2"></i>
            Všetko iba v autorizovaných prostrediach (homelab / CTF / platformy).
          </p>
        </div>

        <div class="col-lg-5">
          <div class="ix-terminal rounded-4 p-4">
            <div class="ix-terminal-top d-flex align-items-center justify-content-between mb-3">
              <div class="text-light fw-bold">
                <i class="fa-solid fa-terminal me-2 text-info"></i>Linux workflow (preview)
              </div>
              <span class="ix-pill ix-pill-muted">labs</span>
            </div>

            <pre class="ix-code mb-0"><code># warmup
ssh bandit0@bandit.labs.overthewire.org -p 2220

# recon basics (authorized only)
ip a
ip r
ss -tulpn
nmap -sV -sC target.local

# wireless notes (lab)
sudo airmon-ng start wlan0
sudo airodump-ng wlan0mon
</code></pre>
          </div>
        </div>
      </div>
    </section>

    <!-- PILLARS -->
    <section class="mb-5">
      <div class="d-flex align-items-end justify-content-between gap-3 mb-3">
        <div>
          <h2 class="ix-title text-light mb-1">
            <i class="fa-solid fa-layer-group text-info me-2"></i>Tri piliere
          </h2>
          <p class="text-secondary mb-0">Aby to bolo pestré: učím sa, skúšam, zapisujem + zdieľam.</p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <article class="ix-card ix-surface rounded-5 p-4 h-100">
            <div class="ix-card-head">
              <div class="ix-ico ix-ico-cyan"><i class="fa-solid fa-graduation-cap"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Learn</h3>
                <p class="text-light-emphasis small mb-0">Základy + nové techniky: Linux, web, sieť, wireless.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="ix-tag">OverTheWire</span><span class="ix-tag">notes</span><span class="ix-tag">basics</span>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <article class="ix-card ix-surface rounded-5 p-4 h-100">
            <div class="ix-card-head">
              <div class="ix-ico ix-ico-purple"><i class="fa-solid fa-flask-vial"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Practice</h3>
                <p class="text-light-emphasis small mb-0">CTF, HackTheBox a vlastné laby (Raspberry Pi).</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="ix-tag">CTF</span><span class="ix-tag">HTB</span><span class="ix-tag">homelab</span>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <article class="ix-card ix-surface rounded-5 p-4 h-100">
            <div class="ix-card-head">
              <div class="ix-ico ix-ico-green"><i class="fa-solid fa-file-pen"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Share</h3>
                <p class="text-light-emphasis small mb-0">Writeups a nástroje — aby sa to dalo učiť aj ostatným.</p>
              </div>
            </div>
            <div class="mt-3 d-flex flex-wrap gap-2">
              <span class="ix-tag">writeups</span><span class="ix-tag">tools</span><span class="ix-tag">community</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- FEATURED SECTIONS -->
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-lg-4">
          <a class="ix-link-card ix-surface rounded-5 p-4 h-100 d-block text-decoration-none" href="writeups.html">
            <div class="d-flex align-items-start gap-3">
              <div class="ix-ico ix-ico-cyan"><i class="fa-solid fa-book-skull"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Writeups</h3>
                <p class="text-light-emphasis mb-0 small">
                  Postupy, poznámky, riešenia a lessons learned z labov.
                </p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-4">
          <a class="ix-link-card ix-surface rounded-5 p-4 h-100 d-block text-decoration-none" href="tools.html">
            <div class="d-flex align-items-start gap-3">
              <div class="ix-ico ix-ico-purple"><i class="fa-solid fa-screwdriver-wrench"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Tools</h3>
                <p class="text-light-emphasis mb-0 small">
                  Zoznam nástrojov + moje vlastné mini tooly (časom).
                </p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-4">
          <a class="ix-link-card ix-surface rounded-5 p-4 h-100 d-block text-decoration-none" href="roadmap.html">
            <div class="d-flex align-items-start gap-3">
              <div class="ix-ico ix-ico-green"><i class="fa-solid fa-route"></i></div>
              <div>
                <h3 class="h5 fw-bold text-light mb-1">Roadmap</h3>
                <p class="text-light-emphasis mb-0 small">
                  Čo sa učím teraz, čo bude ďalej a aké sú ciele.
                </p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- HERO (FUTURISTIC / EPIC) -->
<section class="ix-hero ix-surface ix-hero-epic rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
  <div class="ix-hero-grid"></div>
  <div class="ix-hero-scanlines"></div>

  <div class="row gy-4 align-items-center position-relative">
    <div class="col-lg-7">
      <div class="ix-kicker mb-3">
        <span class="ix-pill ix-pill-accent"><i class="fa-solid fa-compass me-2"></i>Cyber Learning Hub</span>
        <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-terminal me-2"></i>Linux</span>
        <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-wifi me-2"></i>Wireless</span>
        <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-microchip me-2"></i>Raspberry Pi</span>
      </div>

      <h1 class="display-3 fw-black text-light mb-2 ix-glitch" data-text="SENTRIX™">
        SENTRIX™
      </h1>

      <p class="ix-subhero mb-4">
        Futuristický learning hub pre hacking mindset:
        <span class="ix-gradtext">writeups</span>, <span class="ix-gradtext">labs</span>, <span class="ix-gradtext">tools</span>
        a komunita, ktorá rieši veci prakticky.
      </p>

      <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-lg btn-primary px-4 py-3 fw-bold ix-btn-neon" href="writeups.html">
          <i class="fa-solid fa-book-skull me-2"></i>Enter Writeups
        </a>
        <a class="btn btn-lg btn-outline-info px-4 py-3 fw-bold ix-btn-outline-neon" href="roadmap.html">
          <i class="fa-solid fa-route me-2"></i>Roadmap
        </a>
        <a class="btn btn-lg btn-outline-light px-4 py-3 fw-bold ix-btn-outline-soft" href="tools.html">
          <i class="fa-solid fa-screwdriver-wrench me-2"></i>Tools
        </a>
      </div>

      <div class="ix-mission mt-4">
        <div class="ix-mission-tile">
          <i class="fa-solid fa-shield-halved"></i>
          <div>
            <div class="ix-mission-title">Mission</div>
            <div class="ix-mission-desc">Learn → Practice → Document → Repeat</div>
          </div>
        </div>

        <div class="ix-mission-tile">
          <i class="fa-solid fa-lock"></i>
          <div>
            <div class="ix-mission-title">Rules</div>
            <div class="ix-mission-desc">Authorized only • Ethics first</div>
          </div>
        </div>

        <div class="ix-mission-tile">
          <i class="fa-solid fa-signal"></i>
          <div>
            <div class="ix-mission-title">Signal</div>
            <div class="ix-mission-desc">Linux • Wireless • CTF • Homelab</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="ix-terminal rounded-4 p-4 ix-terminal-epic">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="text-light fw-bold">
            <i class="fa-solid fa-satellite-dish me-2 text-info"></i>Signal feed
          </div>
          <span class="ix-pill ix-pill-muted">live*</span>
        </div>

        <pre class="ix-code mb-0"><code>[BOOT] sentrix.core :: online
[FOCUS] linux / wireless / ctf / raspberry-pi
[LAB]   authorized environments only
[NOTE]  convert labs → writeups
—
$ ssh bandit0@bandit.labs.overthewire.org -p 2220
$ sudo airmon-ng start wlan0
$ sudo airodump-ng wlan0mon
</code></pre>

        <p class="small text-secondary mb-0 mt-3">
          *feed je vizuálny, nie reálny monitoring.
        </p>
      </div>
    </div>
  </div>
</section>

    <!-- COMMUNITY / RULES -->
    <section class="ix-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-8">
          <h2 class="ix-title text-light mb-2">
            <i class="fa-solid fa-people-group text-info me-2"></i>Komunita & pravidlá
          </h2>
          <p class="text-light-emphasis mb-0">
            SENTRIX má byť miesto na učenie a zdieľanie. Cieľ je robiť veci správne:
            legálne, eticky a bezpečne — s dôrazom na homelab, CTF a autorizované platformy.
          </p>
        </div>

        <div class="col-lg-4">
          <div class="ix-badgebox rounded-4 p-4">
            <div class="d-flex flex-wrap gap-2">
              <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-user-shield me-2"></i>ethics</span>
              <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-scale-balanced me-2"></i>legal</span>
              <span class="ix-pill ix-pill-muted"><i class="fa-solid fa-lock me-2"></i>authorized only</span>
            </div>
            <a href="community.html" class="btn btn-outline-info w-100 mt-3 fw-bold">
              <i class="fa-solid fa-comments me-2"></i>Komunita
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="ix-cta text-center py-5 rounded-5 mb-3 shadow-lg">
      <div class="display-6 fw-bold text-info mb-3">
        <i class="fa-solid fa-book-skull me-2"></i>
        Začni s prvým writeupom
      </div>
      <p class="fs-4 text-light mb-4">
        Najrýchlejší spôsob ako napredovať: jeden lab → poznámky → writeup → ďalší lab.
      </p>
      <a href="writeups.html" class="btn btn-lg btn-info btn-glow px-5 py-3 fs-5 fw-bold">
        Prejsť na writeups
      </a>
    </section>
  </main>
  <?php include "parts/footer.php"?>

</html>