<?php include "parts/header.php"?>
  <main class="container py-5" id="community">
    <!-- HERO -->
    <section class="cm-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-8">
          <div class="cm-kicker mb-3">
            <span class="cm-pill cm-pill-accent"><i class="fa-solid fa-people-group me-2"></i>Community hub</span>
            <span class="cm-pill cm-pill-muted"><i class="fa-solid fa-lock me-2"></i>authorized only</span>
            <span class="cm-pill cm-pill-muted"><i class="fa-solid fa-scale-balanced me-2"></i>GDPR & rules</span>
          </div>

          <h1 class="display-5 fw-bold text-light mb-3">Komunita (SENTRIX™)</h1>

          <p class="lead fs-4 text-light-emphasis mb-0">
            Priestor, kde si ľudia môžu písať, zdieľať poznámky a posúvať sa vpred — ale tak, aby to bolo
            legálne, bezpečné a bez porušovania súkromia (GDPR).
          </p>
        </div>

        <div class="col-lg-4">
          <div class="cm-box rounded-4 p-4">
            <div class="fw-bold text-light mb-2">Quick rules</div>
            <ul class="cm-mini-list mb-0">
              <li><i class="fa-solid fa-shield"></i> Lab / CTF only</li>
              <li><i class="fa-solid fa-user-shield"></i> Bez osobných údajov</li>
              <li><i class="fa-solid fa-ban"></i> Bez návodov na reálne útoky</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- LIVE CHAT (UI placeholder) -->
    <section class="cm-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-3">
        <div>
          <h2 class="cm-title text-light mb-1">
            <i class="fa-solid fa-comments text-info me-2"></i>Live chat (preview)
          </h2>
          <p class="text-secondary mb-0">
            Toto je zatiaľ UI návrh. Reálny chat sa dá dopojiť neskôr (napr. cez Discord widget alebo vlastný backend).
          </p>
        </div>
        <span class="cm-pill cm-pill-muted"><i class="fa-solid fa-circle text-success me-2"></i>coming soon</span>
      </div>

      <div class="row g-4">
        <div class="col-lg-7">
          <div class="cm-chat rounded-5 p-4 h-100">
            <div class="cm-chat-header">
              <div class="cm-chat-title">
                <i class="fa-solid fa-signal text-info me-2"></i>SENTRIX chat room
              </div>
              <div class="cm-chat-meta">authorized-only • no personal data</div>
            </div>

            <div class="cm-chat-feed" aria-label="Chat messages (preview)">
              <div class="cm-msg">
                <div class="cm-msg-user"><i class="fa-solid fa-user-astronaut me-2"></i>user01</div>
                <div class="cm-msg-text">Tip: k HTB boxu si vždy ukladaj “notes template” (goal → enum → findings).</div>
              </div>
              <div class="cm-msg">
                <div class="cm-msg-user"><i class="fa-solid fa-user-ninja me-2"></i>user02</div>
                <div class="cm-msg-text">Má niekto dobrý filter workflow na Wireshark pre DNS/HTTP?</div>
              </div>
              <div class="cm-msg cm-msg-system">
                <div class="cm-msg-user"><i class="fa-solid fa-shield-halved me-2"></i>system</div>
                <div class="cm-msg-text">Reminder: nezdieľaj IP/mená/domény reálnych cieľov a osobné údaje.</div>
              </div>
            </div>

            <div class="cm-chat-input">
              <input class="form-control form-control-lg cm-input" type="text" placeholder="Napíš správu… (preview)"
                aria-label="Chat input (preview)" disabled />
              <button class="btn btn-info btn-lg fw-bold px-4" type="button" disabled>
                <i class="fa-solid fa-paper-plane me-2"></i>Send
              </button>
            </div>

            <p class="small text-secondary mb-0 mt-3">
              Pozn.: Toto je iba vizuál. Keď budeš chcieť reálny chat, navrhnem najjednoduchšie riešenie (Discord embed
              alebo vlastný chat s moderáciou).
            </p>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="cm-box rounded-4 p-4 h-100">
            <div class="fw-bold text-light mb-2">
              <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>Chat pravidlá
            </div>
            <ul class="cm-mini-list mb-0">
              <li><i class="fa-solid fa-lock"></i> len lab/CTF/platformy</li>
              <li><i class="fa-solid fa-user-shield"></i> bez osobných údajov (GDPR)</li>
              <li><i class="fa-solid fa-ban"></i> bez reálnych cieľov / “hit this” správ</li>
              <li><i class="fa-solid fa-file-pen"></i> odporúčané: píš aj “lesson learned”</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- WHAT IS ALLOWED / NOT ALLOWED + GDPR -->
    <section class="cm-surface rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div>
          <h2 class="cm-title text-light mb-1">
            <i class="fa-solid fa-gavel text-info me-2"></i>Čo sa môže / čo sa nemôže (zákony & GDPR)
          </h2>
          <p class="text-secondary mb-0">
            Cieľ je držať komunitu v bezpečných mantineloch. Toto nie je právne poradenstvo, ale praktické pravidlá.
          </p>
        </div>
        <span class="cm-pill cm-pill-muted"><i class="fa-solid fa-scale-balanced me-2"></i>policy</span>
      </div>

      <div class="row g-4">
        <div class="col-lg-6">
          <section class="cm-panel cm-panel-ok rounded-5 p-4 h-100">
            <h3 class="h5 fw-bold text-light mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i>Povolené</h3>
            <ul class="cm-list mb-0">
              <li>Writeups z <strong>CTF / HTB / OverTheWire / vlastného labu</strong>.</li>
              <li>Vysvetlenia zraniteľností na <strong>vlastných ukážkach</strong> alebo verejných “training” appkách.</li>
              <li>Tool workflow, “ako čítať output”, čo si logovať, ako písať report/notes.</li>
              <li>Hardening odporúčania, defensive tipy, základné checklists.</li>
            </ul>
          </section>
        </div>

        <div class="col-lg-6">
          <section class="cm-panel cm-panel-ban rounded-5 p-4 h-100">
            <h3 class="h5 fw-bold text-light mb-3"><i class="fa-solid fa-circle-xmark text-danger me-2"></i>Nepovolené</h3>
            <ul class="cm-list mb-0">
              <li>Návody typu “target this real site/IP”, doxxing, leaks, ukradnuté dáta.</li>
              <li>Zverejňovanie <strong>osobných údajov</strong> (mená, e-maily, telefón, adresy, identifikátory).</li>
              <li>Zverejňovanie logov/screenshotov, kde sú <strong>reálne identifikátory</strong> bez anonymizácie.</li>
              <li>Malware distribúcia, “droppery”, obchádzanie zákonov/ToS.</li>
            </ul>
          </section>
        </div>
      </div>

      <div class="cm-note mt-4">
        <div class="cm-note-title"><i class="fa-solid fa-user-shield me-2 text-info"></i>GDPR mini-check</div>
        <div class="cm-note-body">
          Pred zdieľaním si polož: “Je tam osobný údaj?” Ak áno → nezverejňovať alebo anonymizovať (maskovať IP, user,
          domény, tokeny, cookies, API keys).
        </div>
      </div>
    </section>

    <!-- HOW TO ADD: writeups / tools -->
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-lg-6">
          <section class="cm-surface rounded-5 p-4 shadow-lg h-100">
            <h2 class="h4 fw-bold text-light mb-2">
              <i class="fa-solid fa-book-skull text-info me-2"></i>Ako pridať: Writeup
            </h2>
            <p class="text-light-emphasis mb-3">
              Drž sa šablóny, aby bol obsah čitateľný aj pre ostatných.
            </p>
            <ol class="cm-ol mb-0">
              <li><strong>Názov</strong> + platforma (CTF/HTB/lab)</li>
              <li><strong>Scope</strong> (čo bolo povolené)</li>
              <li><strong>Postup</strong> + výstupy (bez citlivých dát)</li>
              <li><strong>Lesson learned</strong> + fix/defense poznámka</li>
            </ol>
          </section>
        </div>

        <div class="col-lg-6">
          <section class="cm-surface rounded-5 p-4 shadow-lg h-100">
            <h2 class="h4 fw-bold text-light mb-2">
              <i class="fa-solid fa-toolbox text-info me-2"></i>Ako pridať: Tool
            </h2>
            <p class="text-light-emphasis mb-3">
              Tools stránka má byť “arsenal” – stručné a praktické.
            </p>
            <ol class="cm-ol mb-0">
              <li><strong>Názov toolu</strong> + kategória (recon/web/...)</li>
              <li><strong>Kedy použiť</strong> (1–2 vety)</li>
              <li><strong>Čo si ukladať</strong> (output/notes)</li>
              <li><strong>Bezpečnosť</strong> (authorized-only)</li>
            </ol>
          </section>
        </div>
      </div>
    </section>

    <!-- JOIN (GitHub only) -->
    <section class="cm-surface cm-join rounded-5 p-4 p-lg-5 mb-5 shadow-lg">
      <div class="row g-4 align-items-center">
        <div class="col-lg-8">
          <h2 class="cm-title text-light mb-2">
            <i class="fa-brands fa-github text-info me-2"></i>Join on GitHub
          </h2>
          <p class="text-light-emphasis mb-0">
            Sleduj projekt, posielaj feedback a nápady. Fokus ostáva:
            <strong>authorized only</strong> + <strong>ethics first</strong>.
          </p>

          <div class="d-flex flex-wrap gap-2 mt-4">
            <a class="btn btn-lg btn-outline-light px-4 py-3 fw-bold"
              href="https://github.com/DarkTender/SENTRIX" target="_blank" rel="noopener">
              <i class="fa-brands fa-github me-2"></i>DarkTender/SENTRIX
            </a>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="cm-box rounded-4 p-4">
            <div class="fw-bold text-light mb-2">Čo tam nájdeš</div>
            <ul class="cm-mini-list mb-0">
              <li><i class="fa-solid fa-book-skull"></i> writeups & notes</li>
              <li><i class="fa-solid fa-toolbox"></i> tool workflow</li>
              <li><i class="fa-solid fa-flag"></i> CTF progress</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="cm-surface cm-cta text-center py-5 rounded-5 mb-3 shadow-lg">
      <div class="display-6 fw-bold text-info mb-3">
        <i class="fa-solid fa-book-skull me-2"></i>
        Začni s writeups
      </div>
      <p class="fs-4 text-light mb-4">
        Najlepšia komunita je tá, kde z labov vznikajú kvalitné poznámky a tie posúvajú ďalej ostatných.
      </p>
      <a href="writeups.html" class="btn btn-lg btn-info btn-glow px-5 py-3 fs-5 fw-bold">
        Prejsť na writeups
      </a>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/community_background.js"></script>
</body>

</html>