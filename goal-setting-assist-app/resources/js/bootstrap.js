import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// let milestones = document.querySelectorAll('.milestone');
let dragged = null;
let target = null;
// milestones.forEach(function() {

// ドラッグ開始
document.addEventListener("dragstart", function(event) {
    dragged = event.target;
    milestoneChange();
});

// ドラッグを開始したら起動
const milestoneChange = function() {
    document.addEventListener("dragover", function(event) {
        event.preventDefault();
    });

    document.addEventListener("drop", function(event) {
        if(event.target.classList.contains('milestone')) {
            target = event.target;
            const parentTarget = target.parentNode.parentNode;
            const parentDragged = dragged.parentNode.parentNode;
            // 上から下へドラッグする場合
            if(dragged.dataset.rank < target.dataset.rank) {
                parentTarget.after(parentDragged);
            // 下から上へドラッグする場合
            } else {
                parentTarget.before(parentDragged);
            }

            // フォーム送信アクションを実行する
            const draggedId = dragged.dataset.id;
            const draggedRank = dragged.dataset.rank;
            const targetId = target.dataset.id
            const targetRank = target.dataset.rank;
            milestoneChangeForm(draggedId, draggedRank, targetId, targetRank);
        }
    });
}

// 並び替えフォームを送信する
const milestoneChangeForm = function(draggedId, draggedRank, targetId, targetRank) {
    document.getElementById('draggedId').value = draggedId;
    document.getElementById('draggedRank').value = draggedRank;
    document.getElementById('targetId').value = targetId;
    document.getElementById('targetRank').value = targetRank;
    // console.log(document.getElementById('draggedId').value);
    // console.log(document.getElementById('targetId').value);

    // 送信ボタンをクリックする
    document.getElementById('milestone_btn').click();
}