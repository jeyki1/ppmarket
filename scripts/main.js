(function () {
    var audio     = document.getElementById('ppm-audio');
    var player    = document.getElementById('ppm-player');
    var playBtn   = document.getElementById('player-play');
    var titleEl   = document.getElementById('player-title');
    var fill      = document.getElementById('player-progress-fill');
    var curEl     = document.getElementById('player-cur');
    var durEl     = document.getElementById('player-dur');
    var volSlider = document.getElementById('player-vol');
    var coverImg  = document.getElementById('player-cover');

    var activeItem = null;
    var activeBtn  = null;
    var STORAGE_KEY = 'ppm_player';

    function fmt(sec) {
        sec = Math.floor(sec || 0);
        var m = Math.floor(sec / 60);
        var s = sec % 60;
        return m + ':' + (s < 10 ? '0' : '') + s;
    }

    function resetCard(item, btn) {
        if (!item) return;
        item.classList.remove('playing');
        if (btn) btn.textContent = '▶';
    }

    function setCard(item, btn) {
        item.classList.add('playing');
        if (btn) btn.textContent = '⏸';
    }

    function openPlayer(name, cover) {
        titleEl.textContent = name || '—';
        if (coverImg) {
            if (cover) { coverImg.src = cover; coverImg.style.display = 'block'; }
            else { coverImg.style.display = 'none'; }
        }
        player.style.display = 'flex';
        document.body.classList.add('player-open');
    }

    function saveState() {
        if (!audio.src || audio.src === window.location.href) return;
        try {
            sessionStorage.setItem(STORAGE_KEY, JSON.stringify({
                src:    audio.src,
                name:   titleEl.textContent,
                cover:  coverImg ? coverImg.src : '',
                time:   audio.currentTime,
                vol:    audio.volume,
                paused: audio.paused
            }));
        } catch(e) {}
    }

    function restoreState() {
        try {
            var raw = sessionStorage.getItem(STORAGE_KEY);
            if (!raw) return;
            var s = JSON.parse(raw);
            if (!s.src) return;
            audio.src    = s.src;
            audio.volume = s.vol != null ? parseFloat(s.vol) : 0.8;
            if (volSlider) volSlider.value = audio.volume;
            openPlayer(s.name, s.cover);
            audio.load();
            audio.addEventListener('loadedmetadata', function onMeta() {
                audio.removeEventListener('loadedmetadata', onMeta);
                audio.currentTime = s.time || 0;
                durEl.textContent = fmt(audio.duration);
                if (!s.paused) {
                    audio.play().catch(function(){});
                    playBtn.textContent = '⏸';
                } else {
                    playBtn.textContent = '▶';
                }
            });
        } catch(e) {}
    }

    audio.addEventListener('timeupdate', function () {
        if (!audio.duration) return;
        var pct = (audio.currentTime / audio.duration) * 100;
        fill.style.width = pct + '%';
        curEl.textContent = fmt(audio.currentTime);
        saveState();
    });

    audio.addEventListener('loadedmetadata', function () {
        durEl.textContent = fmt(audio.duration);
    });

    audio.addEventListener('ended', function () {
        playBtn.textContent = '▶';
        fill.style.width = '0%';
        curEl.textContent = '0:00';
        resetCard(activeItem, activeBtn);
        activeItem = null;
        activeBtn  = null;
        try { sessionStorage.removeItem(STORAGE_KEY); } catch(e) {}
    });

    window.playerSeek = function (e) {
        if (!audio.duration) return;
        var bar  = e.currentTarget.querySelector('.player-progress-bar');
        var rect = bar.getBoundingClientRect();
        var pct  = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
        audio.currentTime = pct * audio.duration;
        saveState();
    };

    window.playerToggle = function () {
        if (!audio.src || audio.src === window.location.href) return;
        if (audio.paused) {
            audio.play();
            playBtn.textContent = '⏸';
            if (activeItem) setCard(activeItem, activeBtn);
        } else {
            audio.pause();
            playBtn.textContent = '▶';
            if (activeItem) activeItem.classList.remove('playing');
            if (activeBtn)  activeBtn.textContent = '▶';
        }
        saveState();
    };

    window.playerVol = function (v) {
        audio.volume = parseFloat(v);
        saveState();
    };
    if (volSlider) audio.volume = parseFloat(volSlider.value);

    document.addEventListener('click', function (e) {
        if (e.target.closest('form, a')) return;
        var item = e.target.closest('.beat-item[data-src]');
        if (!item) return;
        var src   = item.dataset.src;
        var name  = item.dataset.name || (item.querySelector('h4') ? item.querySelector('h4').textContent : '—');
        var cover = item.dataset.cover || '';
        var btn   = item.querySelector('.play-btn');

        if (activeItem === item) { playerToggle(); return; }
        if (activeItem) resetCard(activeItem, activeBtn);

        activeItem = item;
        activeBtn  = btn;
        audio.src = src;
        audio.load();
        audio.play().catch(function(err){ console.warn('Audio play error:', err); });
        setCard(item, btn);
        playBtn.textContent = '⏸';
        openPlayer(name, cover);
        saveState();
    });

    window.showToast = function(msg, type) {
        var t = document.createElement('div');
        t.className = 'ppm-toast' + (type === 'success' ? ' ppm-toast--ok' : ' ppm-toast--err');
        t.innerHTML = msg;
        document.body.appendChild(t);
        requestAnimationFrame(function(){ t.classList.add('ppm-toast--in'); });
        setTimeout(function(){
            t.classList.remove('ppm-toast--in');
            setTimeout(function(){ if(t.parentNode) t.parentNode.removeChild(t); }, 400);
        }, 2800);
    };

    document.addEventListener('submit', function(e) {
        var form = e.target;
        if (!form.action || form.action.indexOf('add.php') === -1) return;
        e.preventDefault();
        fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
            .then(function(){ showToast('Бит добавлен в корзину', 'success'); })
            .catch(function(){ showToast('Ошибка. Попробуйте ещё раз.', 'err'); });
    });

    document.addEventListener('submit', function(e) {
        var form = e.target;
        if (!form.action || form.action.indexOf('add_serv.php') === -1) return;
        e.preventDefault();
        fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
            .then(function(){ showToast('Услуга добавлена в корзину', 'success'); })
            .catch(function(){ showToast('Ошибка. Попробуйте ещё раз.', 'err'); });
    });

    document.addEventListener('submit', function(e) {
        var form = e.target;
        if (!form.action || form.action.indexOf('contact.php') === -1) return;
        e.preventDefault();
        fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
            .then(function(){ showToast('Сообщение отправлено', 'success'); form.reset(); })
            .catch(function(){ showToast('Ошибка отправки. Попробуйте позже.', 'err'); });
    });

    document.addEventListener('submit', function(e) {
        var form = e.target;
        if (!form.querySelector('[name="checkout"]')) return;
        e.preventDefault();
        fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
            .then(function(){
                showToast('Покупка оформлена! Переходим в кабинет…', 'success');
                setTimeout(function(){ window.location.href = 'account.php'; }, 2000);
            })
            .catch(function(){ showToast('Ошибка оформления. Попробуйте ещё раз.', 'err'); });
    });

    restoreState();

})();