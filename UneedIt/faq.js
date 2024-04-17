function toggleAnswer(id) {
    var answer = document.getElementById('answer' + id);
    answer.classList.toggle('show');
}

function submitQuestion(event) {
    event.preventDefault();
    var newQuestion = document.getElementById('newQuestion').value;
    console.log('New question submitted:', newQuestion);
    document.getElementById('questionForm').reset();
    alert('Thank you! Your question has been submitted.');
}