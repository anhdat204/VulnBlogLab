<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>VulnBlogLab – Hacker Enhanced</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Fira Code', monospace; }
    @keyframes glow {
      0%, 100% { box-shadow: 0 0 10px #00ff88; }
      50% { box-shadow: 0 0 20px #00ff88, 0 0 30px #00ff88; }
    }
    .glow-card { animation: glow 2.5s infinite; }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: repeating-linear-gradient(to bottom, rgba(0,255,0,0.02), rgba(0,255,0,0.02) 1px, transparent 2px, transparent 4px);
      pointer-events: none;
      z-index: 9999;
    }
  </style>
</head>

<body class="bg-black text-green-400 tracking-wide relative overflow-hidden">
<div class="flex flex-col min-h-screen">
  <canvas id="stars" class="fixed inset-0 -z-10"></canvas>

  <header class="bg-gray-900 border-b border-green-500 shadow px-6 py-4 sticky top-0 z-50">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
      <div class="flex items-center space-x-2">
        <span class="text-xl">💻</span>
        <a href="/" class="text-xl font-bold">VulnBlogLab</a>
      </div>
      <nav class="flex space-x-6 text-sm">
        <a href="/posts/list.php" class="hover:text-lime-300">📚 Bài viết</a>
        <a href="/chat.php" class="hover:text-lime-300">🤖 Chat</a>
        <a href="/login.php" class="hover:text-lime-300">🔑 Đăng nhập</a>
        <a href="/register.php" class="text-black bg-green-400 px-3 py-1 rounded shadow hover:bg-green-300">🚀 Đăng ký</a>
      </nav>
    </div>
  </header>

  <main class="flex-grow">
    <section class="text-center py-10">
      <h1 class="text-4xl font-extrabold text-green-400 mb-2">🛡️ VulnBlogLab</h1>
      <p id="typewriter" class="text-green-300 text-sm min-h-[1.5rem]"></p>
      <div class="mt-6">
        <a href="/login.php" class="bg-green-500 hover:bg-green-600 text-black px-5 py-2 rounded font-medium">
          🚪 Bắt đầu khai thác
        </a>
      </div>
    </section>

    <section class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto px-6 pb-16">
      <?php
      $labs = [
        ['SQL Injection', '💉', 'login.php', 'Bypass login bằng OR 1=1 --'],
        ['Stored XSS', '🧠', 'posts/view.php?id=1', 'Tạo bình luận chứa script.'],
        ['Upload Shell', '📂', 'upload.php', 'Upload .php để kiểm thử RCE.'],
        ['IDOR + XSS', '🧍', 'profile.php?id=2', 'Truy cập profile người khác và chèn XSS.'],
        ['CSRF', '🔁', 'settings.php', 'Form giả đổi thông tin người dùng.'],
        ['Reflected XSS', '🔎', 'search.php?q=', 'Phản chiếu dữ liệu nhập trên URL.'],
        ['Email Injection', '📮', 'contact.php', 'Inject tiêu đề qua \\nBCC.'],
        ['Open Redirect', '🔀', 'redirect.php?url=https://evil.com', 'Chuyển hướng URL không kiểm tra.'],
        ['LFI – Local File Inclusion', '📄', 'page.php?page=../../etc/passwd', 'Đọc file qua biến page.'],
        ['Admin Dashboard', '👑', 'admin/index.php', 'Truy cập giao diện quản trị.'],
      ];

      foreach ($labs as [$title, $icon, $url, $desc]) {
        echo <<<HTML
        <div class="bg-[#0d0d0d] border border-green-500 rounded-lg p-5 glow-card">
          <h3 class="text-green-400 font-bold text-lg mb-2">{$icon} {$title}</h3>
          <p class="text-green-300 text-sm mb-3">{$desc}</p>
          <a href="/{$url}" class="text-lime-300 hover:underline text-sm">Thử ngay →</a>
        </div>
        HTML;
      }
      ?>
    </section>
  </main>

  <footer class="bg-gray-900 border-t border-green-500 text-center py-4 text-green-300 text-sm">
    © 2025 <strong>VulnBlogLab</strong> — Made by <span class="text-lime-400">0xadt204</span> for security learning. 🚩
  </footer>
</div>

<script>
  const text = "🧠 Khai thác SQLi, XSS, CSRF, IDOR, LFI... trong môi trường mô phỏng.";
  let i = 0;
  const type = () => {
    if (i < text.length) {
      document.getElementById("typewriter").textContent += text.charAt(i++);
      setTimeout(type, 50);
    }
  };
  type();
  const c = document.getElementById('stars'), ctx = c.getContext('2d');
  c.width = window.innerWidth; c.height = window.innerHeight;
  let stars = Array(100).fill().map(() => ({ x: Math.random() * c.width, y: Math.random() * c.height, r: Math.random() * 1.5 }));
  function draw() {
    ctx.clearRect(0, 0, c.width, c.height);
    stars.forEach(s => {
      ctx.beginPath(); ctx.arc(s.x, s.y, s.r, 0, 2 * Math.PI); ctx.fillStyle = "#0f0"; ctx.fill();
      s.y += 0.3; if (s.y > c.height) s.y = 0;
    });
    requestAnimationFrame(draw);
  }
  draw();
</script>

</body>
</html>
