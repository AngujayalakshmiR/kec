<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Study Plan Generator</title>
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background: #f5f7fa;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px;
    }
    h1 {
      color: #333;
    }
    textarea {
      width: 100%;
      max-width: 500px;
      height: 100px;
      padding: 15px;
      font-size: 16px;
      margin-top: 20px;
      border-radius: 10px;
      border: 1px solid #ccc;
      resize: none;
    }
    button {
      margin-top: 20px;
      padding: 12px 24px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }
    button:hover {
      background-color: #45a049;
    }
    .output {
      margin-top: 30px;
      padding: 20px;
      max-width: 700px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
      white-space: pre-wrap;
    }
    .loading {
      color: #555;
      font-style: italic;
    }
  </style>
</head>
<body>

  <h1>📚 AI-Powered Study Plan Generator</h1>

  <textarea id="userInput" placeholder="Type something like: I want a study plan for Python..."></textarea>
  <br/>
  <button onclick="generatePlan()">Generate Plan</button>

  <div id="result" class="output"></div>

  <script>
    async function generatePlan() {
      const input = document.getElementById("userInput").value.trim();
      const resultDiv = document.getElementById("result");

      if (!input) {
        resultDiv.innerHTML = "❌ Please enter a topic!";
        return;
      }

      resultDiv.innerHTML = "<p class='loading'>⏳ Generating your plan...</p>";

      try {
        const response = await fetch("https://9d61-34-66-32-250.ngrok-free.app/get_plan", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ text: input })
        });

        const data = await response.json();

        resultDiv.innerHTML = `
          <strong>✅ Corrected Input:</strong> ${data.corrected}<br/><br/>
          <strong>📘 Study Plan:</strong><br/>${data.study_plan}
        `;
      } catch (err) {
        console.error(err);
        resultDiv.innerHTML = "❌ Error generating study plan. Please try again.";
      }
    }
  </script>
</body>
</html>
