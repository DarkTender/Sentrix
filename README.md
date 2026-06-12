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

> ⚠️ **Varovanie:** Táto platforma je určená iba na **vzdelávací účel. Používajte ju zodpovedne a legálne!**
---

## 🎯 Hlavné Features

| Feature | Popis |
|---------|-------|
| 💉 **Web Exploits** | SQLi, JWT attacks - Nauč sa hľadať a exploitovať webové zraniteľnosti |
| 🔐 **Crypto Challenges** | Dešifrovanie, dekryptácia a prelomenie šifier - Posilňuj svoje kryptografické zručnosti |
| ⚙️ **System Labs** | Privilege escalation, exploitácia súborov - Másteruje systémové bezpečnostné hry |
| 🎖️ **Role-based Access** | Staň sa adminom, posuň sa v leaderboarde - Konkuruj s ostatnými študentami |

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
│ 💉 Web           → SQLi │
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
- JWT vulnerabilities

### 🔐 **Cryptography**
- Base64 encoding/decoding

### ⚙️ **System Administration**
- Privilege escalation techniky

### 👑 **Access Control**
- Role-Based Access Control (RBAC)
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
