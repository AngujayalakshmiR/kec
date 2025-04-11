<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Grammar Correction & TTS</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f4f6;
      padding: 2rem;
      text-align: center;
    }
    h2 {
      color: #1f2937;
    }
    textarea {
      width: 80%;
      height: 120px;
      margin-top: 1rem;
      padding: 1rem;
      font-size: 16px;
      border-radius: 12px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 1rem;
      padding: 10px 20px;
      font-size: 16px;
      background-color: #2563eb;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    button:hover {
      background-color: #1d4ed8;
    }
    #correctedText {
      margin-top: 1.5rem;
      font-size: 18px;
      color: #111827;
      background: #e0f2fe;
      padding: 1rem;
      border-radius: 10px;
      display: none;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
    }
    audio {
      margin-top: 1.5rem;
    }
  </style>
</head>
<body>

  <h2>Grammar Correction with Speech Output</h2>

  <textarea id="inputText" placeholder="Enter your sentence..."></textarea><br>
  <button onclick="submitText()">Correct & Speak</button>

  <div id="correctedText"></div>
  <audio id="audioPlayer" controls style="display: none;"></audio>
  <script>
  async function submitText() {
    const inputText = document.getElementById("inputText").value.trim();
    if (!inputText) {
      alert("Please enter some text!");
      return;
    }

    // Step 1: Get corrected text
    const grammarResponse = await fetch("https://98b5-34-172-99-72.ngrok-free.app/grammar", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ text: inputText })
    });

    const grammarData = await grammarResponse.json();
    const corrected = grammarData.corrected;

    // Display corrected text
    const correctedDiv = document.getElementById("correctedText");
    correctedDiv.textContent = "✅ Corrected Sentence: " + corrected;
    correctedDiv.style.display = "block";

 
  }
</script>


</body>
</html>
