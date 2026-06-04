```
 ███████╗███████╗███╗   ██╗████████╗██████╗ ██╗██╗  ██╗
 ██╔════╝██╔════╝████╗  ██║╚══██╔══╝██╔══██╗██║╚██╗██╔╝
 ███████╗█████╗  ██╔██╗ ██║   ██║   ██████╔╝██║ ╚███╔╝ 
 ╚════██║██╔══╝  ██║╚██╗██║   ██║   ██╔══██╗██║ ██╔██╗ 
 ███████║███████╗██║ ╚████║   ██║   ██║  ██║██║██╔╝ ██╗
 ╚══════╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚═╝  ╚═╝╚═╝╚═╝  ╚═╝
                                                          
  > Master Cybersecurity Through Real Exploitation Labs <
  > $ whoami: Student | State: Learning Mode [████████░] <
```

---

## 🔓 O Sentrix

**Sentrix** je interaktívna trénovacia platforma určená pre študentov a nadšencov kyberbezpečnosti. Ponúka realistické, praktické výzvy z oblasti **etického hackingu** a **penetračného testovania**.

> ⚠️ **Varovanie:** Táto platforma je určená iba na **vzdelávací účel**.  Používajte ju zodpovedne a legálne!

---

## 🎯 Hlavné Features

| Feature | Popis |
|---------|-------|
| 💉 **Web Exploits** | SQLi, XSS, IDOR, JWT attacks - Nauč sa hľadať a exploitovať webové zraniteľnosti |
| 🔐 **Crypto Challenges** | Dešifrovanie, dekryptácia a prelomenie šifier - Posilňuj svoje kryptografické zručnosti |
| ⚙️ **System Labs** | Privilege escalation, exploitácia súborov - Másteruje systémové bezpečnostné hry |
| 🎖️ **Role-based Access** | Staň sa adminom, posuň sa v leaderboarde - Konkuruj s ostatnými študentami |

---

## 🏗️ Technologická Architektúra

---

## 📂 Štruktúra Projektu

```
Sentrix/
├── app/                           # Aplikačná logika
│   ├── core/
│   │   ├── Auth.php              # ✓ Autentifikácia & Session management
│   │   └── Database.php          # ✓ Databázové konekcie (PDO)
│   └── models/
│       ├── Challenge.php         # ✓ CRUD operácie s výzvami
│       └── User.php              # ✓ Správa užívateľských údajov
│
├── public/                        # Verejný front-end
│   ├── challenge.php             # Zobrazenie jednotlivej výzvy
│   ├── challenges.php            # Zoznam všetkých výziev
│   ├── dashboard.php             # Užívateľský dashboard
│   ├── leaderboard.php           # Rebríček bodov
│   ├── login.php                 # Prihlasovacia formulár
│   ├── logout.php                # Odhlásenie
│   ├── profile.php               # Profil užívateľa
│   │
│   ├── admin/                    # Admin panel
│   │   ├── admin.php             # Admin dashboard
│   │   ├── users.php             # Správa užívateľov
│   │   ├── edit_challenge.php    # Editácia výziev
│   │   └── delete_challenge.php  # Mazanie výziev
│   │
│   ├── user/
│   │   └── user.php              # Užívateľské funkcie
│   │
│   └── challenge-types/          # 🎯 Typy exploitov
│       ├── web.php               # Web security challenges
│       ├── sqli.php              # SQL Injection lab
│       ├── crypto.php            # Cryptography challenges
│       ├── system.php            # System exploitation
│       ├── role.php              # Role-based access control
│       └── become_admin.php      # Privilege escalation
│
├── views/                         # HTML šablóny
│   ├── header.php                # Navigačná lišta
│   ├── footer.php                # Päta stránky
│   ├── login.php                 # Login form
│   └── Register.php              # Registračná forma
│
├── css/                          # Štýly (27.4%)
│   └── homepage.css              # Design s hackerskými efektami
│
├── js/                           # JavaScripty (13.9%)
│   └── homepage.js               # Interaktivita & animácie
│
├── db/
│   └── sentrix.sql              # Databázová schéma
│
├── config.php                    # Konfigurácia (DB, BASE_URL)
├── index.php                     # Landing page
└── LICENSE                       # MIT License
```

---

## 🔬 Ako to Funguje - Princípy

### 1️⃣ **Autentifikácia a Bezpečnosť**
```php
// app/core/Auth.php
Každý užívateľ sa musí prihlásiť cez login.php
Sessions sa ukladajú v $_SESSION['user']
Admin môže pristúpiť len s role = 'admin'
```

### 2️⃣ **Databázová Vrstva**
```php
// app/core/Database.php
PDO prepared statements = SQL Injection ochrana
Všetky queries používajú parameterizované dotazy
Bezpečné CRUD operácie cez Challenge model
```

### 3️⃣ **Výzvy a Challenges**
```php
// app/models/Challenge.php
Každá výzva má:
  - Title & Description
  - Category (web, crypto, system, role)
  - Difficulty level (Easy, Medium, Hard)
  - Correct answer / Flag
  - Body (points)
```

### 4️⃣ **Typy Výziev**
```
┌──────────────────────────────────────┐
│ CHALLENGE TYPES (public/challenge-types/)    │
├──────────────────────────────────────┤
│ 💉 Web           → SQLi, XSS, IDOR exploits │
│ 🔐 Crypto        → Cipher breaking          │
│ ⚙️ System         → Privilege escalation     │
│ 👑 Role          → RBAC vulnerabilities     │
│ 🚀 Admin         → Become admin challenge   │
└──────────────────────────────────────┘
```

---

## 🚀 Quick Start - Ako Začať

### Instalácia

```bash
# 1. Klonuj repo
git clone https://github.com/DarkTender/Sentrix.git
cd Sentrix

# 2. Nastav databázu
mysql -u root < db/sentrix.sql

# 3. Uprav config.php
nano config.php
# Nastav DB_HOST, DB_NAME, DB_USER, DB_PASS

# 4. Spusti lokálny server
php -S localhost:8000

# 5. Otvor v prehliadači
# http://localhost:8000/index.php
```

---

## 🎓 Čo Sa Naučíš?

### 💉 **Web Security**
- SQL Injection (SQLi) - Ako prelomiť databázové dotazy
- Cross-Site Scripting (XSS) - JavaScript injection
- Insecure Direct Object References (IDOR)
- JWT vulnerabilities

### 🔐 **Cryptography**
- Substitučné šifry
- Caesar cipher, ROT13
- Base64 encoding/decoding
- Hashovanie a SSL/TLS principy

### ⚙️ **System Administration**
- Privilege escalation techniky
- File permissions a SUID bits
- Command injection
- Shell metacharacters

### 👑 **Access Control**
- Role-Based Access Control (RBAC)
- Authentication bypass
- Session hijacking
- Token manipulation
---

## 👨‍💻 Ako Prispieť

```bash
# Fork the repo
git clone https://github.com/YOUR-USERNAME/Sentrix.git
cd Sentrix
git checkout -b feature/my-feature

# Uprav kód
# Commit zmeny
git add .
git commit -m "Add: New challenge type"
git push origin feature/my-feature

# Vytvor Pull Request
```

---

## 📝 Licencia

MIT License - Pozri [LICENSE](LICENSE) file

---

## 🤝 Kontakt & Support

- **GitHub Issues:** [Nahláš problém](https://github.com/DarkTender/Sentrix/issues)
- **Autor:** Dušan Šavrda

---

## ⚡ Disclaimer

```
Táto platforma je IBA na vzdelávací účel.
Používaj ju IBA na systémoch, ktoré vlastníš alebo
máš EXPLICITNÝ SÚHLAS na testing.

Neschválené testovanie je TRESTNÉ.
```

---

```
> $ ./sentrix --version
Sentrix v1.0 - The Hacker's Academy
> $ chmod +x knowledge.sh && ./knowledge.sh
Loading cybersecurity training... [████████████████████] 100%
Ready to learn? Let's hack ethically! 🎯
```

**Made with 💻 & ☕ for Cybersecurity Students**
