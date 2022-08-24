const divComment = document.getElementById('search');
const content = document.getElementById('content');
const loadButton = document.getElementById('loadPosts');
const deleteButton = document.getElementById('deleteButton');
const findButton = document.getElementById('findButton');
const findInput = document.getElementById('findInput');

async function loadAllPosts(){
    const postAnswer = await fetch('https://jsonplaceholder.typicode.com/posts');
    const commentsAnswer = await fetch('https://jsonplaceholder.typicode.com/comments');
    const comments = await commentsAnswer.json();
    const posts = await postAnswer.json();
    
    posts.forEach(async e => {
        await fetch(`http://inline/api/?method=loadPosts&post_id=${e.id}&userId=${e.userId}&title=${e.title}&body=${e.body}`);
    });
    comments.forEach(async e => {
        await fetch(`http://inline/api/?method=loadComments&id=${e.id}&postId=${e.postId}&name=${e.name}&email=${e.email}&body=${e.body}`);
    });
    console.log('Загружено ' + posts.length + ' записей и ' + comments.length + ' комментариев');
}

loadButton.addEventListener('click', () => {
    loadAllPosts();
});

deleteButton.addEventListener('click', () => {
    fetch('http://inline/api/?method=deleteAll');
});

findButton.addEventListener('click', async () => {
    content.innerHTML = ``;
    const answer = await fetch(`http://inline/api/?method=findComment&str=${findInput.value}`);
    const result = await answer.json();
    const data = result.data;
    if(findInput.value.length < 3){
        alert('Введите минимум 3 символа');
    }
    for(let i = 0; i < data.length; i++){
        content.innerHTML += `
        <div class="titles">
                <label class="title">Заголовок:</label>
                ${data[i].title}
        </div>
        <div class="comments">
            <label class="comment">Комментарий:</label>
            ${data[i].body}
        </div>`;
    }
});
