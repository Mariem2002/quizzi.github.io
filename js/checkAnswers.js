

function checkAnswers() {
    const answers = {
        q1: "Paris",
        q2: "Tokyo",
        q3: "Ottawa"
    };
    let score = 0;

    for (const [key, value] of Object.entries(answers)) {
        const selectedOption = document.querySelector(`input[name="${key}"]:checked`);
        if (selectedOption && selectedOption.value === value) {
            score++;
        }
    }

    const resultElement = document.getElementById("result");
    resultElement.textContent = `You scored ${score} out of ${Object.keys(answers).length}`;
}
