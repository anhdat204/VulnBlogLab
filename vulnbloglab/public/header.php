<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
  <meta charset="UTF-8">
  <title>VulnBlogLab</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      darkMode: 'class'
    };
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const html = document.documentElement;

      if (localStorage.theme === 'dark') {
        html.classList.add('dark');
      }
      const toggle = document.getElementById('dark-toggle');
      toggle?.addEventListener('click', () => {
        html.classList.toggle('dark');
        localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
      });
    });
  </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">

<header class="bg-gray-950 text-white px-6 py-4 shadow-lg sticky top-0 z-50">
  <div class="flex justify-between items-center max-w-7xl mx-auto">
    <div class="flex items-center space-x-2">
      <span class="text-2xl">🔐</span>
      <a href="/" class="text-xl font-extrabold tracking-wide">VulnBlogLab</a>
    </div>
    <nav class="ml-auto flex space-x-6 text-sm font-medium"> 
      <a href="/posts/list.php" class="hover:text-blue-400 transition">📚 Bài viết</a>
      <a href="/chat.php" class="hover:text-blue-400 transition">🤖 AI Chat</a>
      <a href="/login.php" class="hover:text-blue-400 transition">🔑 Đăng nhập</a>
      <a href="/register.php" class="bg-gradient-to-r from-blue-500 to-purple-600 px-4 py-1 rounded text-white shadow hover:scale-105 transition">🚀 Đăng ký</a>
    </nav>
    <button id="dark-toggle" class="ml-4 text-yellow-400 hover:text-white text-lg">🌗</button>
  </div>
</header>
