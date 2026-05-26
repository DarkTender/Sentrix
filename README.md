# ⚡ SENTRIX

**Master Cybersecurity Through Real Exploitation Labs**

Sentrix is a comprehensive cybersecurity training platform designed to help security enthusiasts, students, and professionals master hacking techniques through practical, hands-on exploitation labs.

## 🎯 Overview

Sentrix provides a structured learning environment where you can practice real-world cybersecurity exploitation techniques. From web vulnerabilities to cryptographic challenges and system-level exploits, Sentrix covers the full spectrum of modern cybersecurity threats and defenses.

## ✨ Features

### 💉 Web Exploits
Master the most common web vulnerabilities:
- **SQLi** (SQL Injection) - Learn to exploit database queries
- **XSS** (Cross-Site Scripting) - Understand DOM and reflected attacks
- **IDOR** (Insecure Direct Object Reference) - Practice authorization bypass
- **JWT Attacks** - Break and forge JSON Web Tokens

### 🔐 Crypto Challenges
Develop your cryptographic skills:
- Decode various cipher texts
- Decrypt protected messages
- Break encryption algorithms
- Learn cryptanalysis techniques

### ⚙ System Labs
Advance your system security knowledge:
- Privilege escalation techniques
- File system exploitation
- Process manipulation
- Local security bypass

## 🚀 Quick Start

### Prerequisites
- PHP 7.0 or higher
- MySQL/MariaDB database
- A web server (Apache, Nginx, etc.)
- Web browser with modern JavaScript support

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/DarkTender/Sentrix.git
   cd Sentrix
   ```

2. **Configure the database**
   - Edit `config.php` with your database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'sentrix');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

3. **Create the database**
   ```bash
   mysql -u root -p < db/setup.sql
   ```

4. **Start training**
   - Open your browser and navigate to the application
   - Create an account
   - Begin with introductory labs and progress through increasingly difficult challenges

## 📁 Project Structure

```
Sentrix/
├── index.php              # Home page and main entry point
├── config.php             # Database and application configuration
├── app/                   # Application logic and handlers
├── public/                # Public-facing pages (login, registration, etc.)
├── views/                 # Reusable template components
├── db/                    # Database schema and setup scripts
├── css/                   # Stylesheets and UI components
└── LICENSE               # MIT License
```

## 🛠 Technology Stack

- **Backend**: PHP
- **Frontend**: HTML5, CSS3, JavaScript
- **Database**: MySQL/MariaDB
- **License**: MIT

## 📊 Language Composition

- PHP: 62% - Core backend logic
- CSS: 32% - Styling and UI
- Hack: 2% - Type checking and optimization

## 🎓 Learning Path

1. **Beginner**: Start with foundational web exploit challenges
2. **Intermediate**: Progress to complex multi-stage scenarios
3. **Advanced**: Master system-level exploits and crypto challenges
4. **Expert**: Complete advanced real-world exploitation scenarios

## 🔒 Security Notice

**Educational Purpose Only**: Sentrix is designed for educational and authorized security testing purposes only. Unauthorized access to computer systems is illegal. Always ensure you have proper authorization before testing security vulnerabilities.

## 📝 How to Contribute

We welcome contributions from the security community! Here's how you can help:

1. Report bugs and security issues responsibly
2. Suggest new lab scenarios and challenges
3. Improve documentation and tutorials
4. Fix typos and improve code quality
5. Share your learning resources

## 🐛 Bug Reports

If you discover a vulnerability or bug in Sentrix, please report it responsibly to the maintainers.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🤝 Support

For questions, issues, or suggestions, please open an issue on the GitHub repository or reach out to the maintainers.

## 💡 Tips for Success

- Start with simpler challenges to understand the basics
- Take notes on techniques and vulnerabilities you learn
- Practice on local instances before attempting real scenarios
- Join security communities to share knowledge and experiences
- Always follow ethical guidelines and legal requirements

---

**Ready to become an elite hacker?** [Start Training Now](public/login.php)

---

Made with ⚡ by the security community. Happy hacking (ethically)!
