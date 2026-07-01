# HuruLearn Secondary Education Chatbot Platform

HuruLearn is an AI-powered educational assistant designed for secondary school students in Tanzania. It bridges the digital divide by delivering curriculum-aligned academic tutoring through both **offline SMS (basic phones)** and an **online web application**.

---

## 🚀 Core Features

### 1. Offline SMS Chatbot (Africa's Talking Gateway)
- **Keyword Trigger**: Handles inbound SMS requests routed from Africa's Talking gateway. It listens for messages beginning with the keyword `HURU` (case-insensitive), strips the prefix, processes the query, and replies via SMS.
- **Auto-Language Detection**: Uses a built-in keyword detector ([LanguageDetector](app/Services/LanguageDetector.php)) to resolve whether the query is in English or Swahili, defaulting to Swahili if undetermined.
- **Plain-Text Constraint Handling**: Implements custom prompt building ([PromptEngine](app/Services/PromptEngine.php)) that strictly forces the AI to output response blocks in 100% clean plain-text. **Markdown formatting and raw asterisks (`*`) are prohibited** to ensure optimal readability on basic mobile phones.
- **Consistent Footers**: Appends branding footnotes: `"Msaidizi wa HuruLearn."` (Swahili) or `"HuruLearn Secondary Education."` (English).

### 2. Online Web Chat
- **Instant Web Chat**: Accessible at `/chat`, allowing students with internet data to log in using their phone numbers and chat interactively with the AI tutor.
- **History and Filters**: Allows filtering past chats by date and keyword search.
- **Login Redirects**: If a guest attempts to access community forums, the application redirects them to the chat login screen while preserving their target URL. Once authenticated, they are automatically routed back to their destination.

### 3. Community Discussion Boards
- **Thread Forums**: Located at `/community`. Registered students can join public or private discussion threads, create new threads, and post comments or homework questions.

### 4. Admin Management Dashboard
- **Admin Portal**: Protected under basic HTTP authentication at `/admin`.
- **System Settings**: Configure maximum word counts, maximum tokens, temperature, and maintenance message blocks.
- **Prompt Template Editor**: Customize system instructions and templates dynamically per language.
- **Curriculum Document Importer**: A versatile upload tool supporting **CSV**, **JSON**, and **TXT** files. Paragraph-divided txt files or json lists can be uploaded directly to populate the active secondary school syllabus database.

### 5. Progressive Web App (PWA)
- Custom PWA modal on the homepage welcomes mobile users, allowing them to install the web app directly onto their Android or iOS device home screen.

---

## 🛠 Tech Stack & Integration
- **Framework**: [Laravel 12](https://laravel.com)
- **Frontend**: [Vite](https://vite.dev) & [TailwindCSS v4](https://tailwindcss.com)
- **Database**: MySQL (local development)
- **AI Engine**: Google Gemini API via [AiService](app/Services/AiService.php). Powered by the fast `gemini-flash-lite-latest` model. Runs with local SSL certificate verification bypassed (`Http::withoutVerifying()`) to prevent environment handshake issues.
- **SMS Gateway**: [Africa's Talking SDK](https://africastalking.com)

---

## ⚙️ Initial Setup & Commands

To get this project running on your local machine:

1. **Environment Config**:
   Configure database details and API credentials in your `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=hurulearn_edu
   DB_USERNAME=root
   DB_PASSWORD=

   # Africa's Talking API Credentials
   AT_USERNAME=your_username
   AT_API_KEY=your_api_key
   AT_FROM=your_shortcode

   # Gemini API Credentials
   GEMINI_API_KEY=your_gemini_api_key
   ```

2. **Dependencies & Assets Setup**:
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Key and Database Migrations**:
   Ensure MySQL is running, then execute:
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   ```
   *Seeding seeds standard settings, prompt templates, community threads, and comprehensive English (48 entries) and Swahili (36 entries) secondary school curriculum documents.*

4. **Run Development Server**:
   ```bash
   npm run dev
   ```

5. **Clear Configuration Cache**:
   If you update `.env` settings, clear Laravel config cache:
   ```bash
   php artisan config:clear
   ```

---

## 🧪 Testing

The platform includes full feature tests verifying SMS incoming request parsing, jobs dispatching, AI mock loops, and community creation:
```bash
php artisan test
```
