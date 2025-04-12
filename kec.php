<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Study Buddy AI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .chat-container {
      max-width: 700px;
      margin: 50px auto;
      background: white;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      padding: 30px;
    }
    .message {
      margin-bottom: 15px;
      padding: 10px 15px;
      border-radius: 10px;
    }
    .user { background: #d1e7dd; text-align: right; }
    .bot { background: #e2e3e5; text-align: left; }
  </style>
</head>
<body>

<div class="chat-container">
  <h3 class="text-center mb-4">📚 Study Buddy Chatbot</h3>
  <div id="chatBox"></div>
  <div class="input-group mt-4">
    <input type="text" id="userInput" class="form-control" placeholder="Ask me anything...">
    <button class="btn btn-primary" onclick="sendMessage()">Send</button>
  </div>
</div>

<script>
  const chatBox = document.getElementById("chatBox");

  async function sendMessage() {
    const input = document.getElementById("userInput");
    const message = input.value.trim();
    if (!message) return;

    appendMessage("user", message);
    input.value = "";

    const response = await fetch("https://5e46-35-245-253-32.ngrok-free.app/chat", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message })
    });

    const data = await response.json();
    appendMessage("bot", data.response);
  }

  function appendMessage(sender, text) {
    const msgDiv = document.createElement("div");
    msgDiv.className = `message ${sender}`;
    msgDiv.innerText = text;
    chatBox.appendChild(msgDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  
</script>

</body>
</html>
