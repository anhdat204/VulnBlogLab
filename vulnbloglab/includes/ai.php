<?php
function call_ai($user_prompt)
{
  $api_key = 'AIzaSyA6F-XK-_j9vM-kQwc9FqkFl9gy3uEdKOo';
  $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$api_key";

  $data = [
    "contents" => [
      ["parts" => [["text" => $user_prompt]]]
    ]
  ];

  $headers = [
    "Content-Type: application/json"
  ];

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  file_put_contents('ai-error-log.json', $response);


  $result = json_decode($response, true);
  return $result['candidates'][0]['content']['parts'][0]['text'] ?? '⚠️ Lỗi gọi Gemini API';
}
