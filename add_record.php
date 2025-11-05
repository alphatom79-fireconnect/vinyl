<?php
// add_record.php
require_once __DIR__ . '/init.php';
requireLogin(); extendSession();
$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dodaj płytę - Biblioteczka Płyt Winylowych</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar">
  <div class="nav-container">
    <div class="nav-logo"><h2>🎵 Biblioteczka Płyt</h2></div>
    <ul class="nav-menu">
      <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
      <li><a href="add_record.php" class="nav-link active">Dodaj płytę</a></li>
      <li><a href="browse_records.php" class="nav-link">Przeglądaj płyty</a></li>
      <li class="nav-user"><span>Witaj, <?= sanitizeOutput($_SESSION['username']) ?>!</span><a href="logout.php" class="btn btn-secondary btn-small">Wyloguj</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="page-header"><h1>Dodaj nową płytę</h1><p>Dodaj płytę winylową do swojej kolekcji</p></div>
  <div id="messages"></div>

  <form id="addRecordForm" class="record-form" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <div class="form-grid">
      <div class="form-section">
        <h3>Podstawowe informacje</h3>
        <div class="form-group"><label for="artist">Wykonawca *</label><input type="text" id="artist" name="artist" required></div>
        <div class="form-group"><label for="title">Tytuł płyty *</label><input type="text" id="title" name="title" required></div>
        <div class="form-row">
          <div class="form-group"><label for="release_year">Rok wydania *</label><input type="number" id="release_year" name="release_year" min="1900" max="<?= date('Y') ?>" required></div>
          <div class="form-group"><label for="price">Cena (zł) *</label><input type="number" id="price" name="price" min="0" step="0.01" required></div>
        </div>
        <div class="form-group"><label for="cover_image">Okładka płyty</label><input type="file" id="cover_image" name="cover_image" accept="image/*"><small>Dozwolone formaty: JPG, PNG, GIF (max 5MB)</small></div>
      </div>

      <div class="form-section">
        <h3>Lista utworów</h3><p>Dodaj utwory znajdujące się na płycie:</p>
        <div id="tracks-container">
          <div class="track-item" data-track="1">
            <div class="form-row">
              <div class="form-group track-number"><label>Nr</label><input type="number" name="tracks[asset:1][number]" value="1" readonly></div>
              <div class="form-group track-title"><label>Tytuł utworu</label><input type="text" name="tracks[asset:1][title]" placeholder="Wprowadź tytuł utworu"></div>
              <div class="form-group track-duration"><label>Czas</label><input type="text" name="tracks[asset:1][duration]" placeholder="mm:ss" pattern="[0-9]{1,2}:[0-9]{2}"></div>
              <div class="track-actions"><button type="button" class="btn btn-danger btn-small remove-track" onclick="removeTrack(1)" style="display:none;">Usuń</button></div>
            </div>
          </div>
        </div>
        <div class="track-controls"><button type="button" id="addTrack" class="btn btn-secondary">➕ Dodaj utwór</button><span class="track-count">Utworów: <span id="trackCount">1</span></span></div>
      </div>
    </div>
    <div class="form-actions"><button type="submit" class="btn btn-primary" id="submitBtn">💾 Dodaj płytę</button><button type="reset" class="btn btn-secondary">🔄 Wyczyść formularz</button></div>
  </form>

  <div class="records-table-section" style="margin-top:2rem;">
    <h2>Dodane płyty</h2>
    <div id="recordsTable"></div>
  </div>
</div>

<footer class="footer"><div class="container"><p>&copy; 2025 Biblioteczka Płyt Winylowych. Wszystkie prawa zastrzeżone.</p></div></footer>

<script src="js/script.js"></script>
<script>
// Inicjalizacja
document.addEventListener('DOMContentLoaded', function(){
  loadRecordsTable();
  initializeTrackManagement();
  initializeFormSubmission();
});

// Zarządzanie utworami
function initializeTrackManagement(){
  updateTrackCount(); updateRemoveButtons();
  const btn=document.getElementById('addTrack');
  if (btn){ btn.addEventListener('click', function(){
    const next=document.querySelectorAll('#tracks-container .track-item').length+1;
    addTrackField(next); updateTrackCount(); updateRemoveButtons();
  });}
}
function addTrackField(n){
  const c=document.getElementById('tracks-container'); const d=document.createElement('div');
  d.className='track-item'; d.setAttribute('data-track',n);
  d.innerHTML=`
    <div class="form-row">
      <div class="form-group track-number"><label>Nr</label><input type="number" name="tracks[${n}][number]" value="${n}" readonly></div>
      <div class="form-group track-title"><label>Tytuł utworu</label><input type="text" name="tracks[${n}][title]" placeholder="Wprowadź tytuł utworu"></div>
      <div class="form-group track-duration"><label>Czas</label><input type="text" name="tracks[${n}][duration]" placeholder="mm:ss" pattern="[0-9]{1,2}:[0-9]{2}"></div>
      <div class="track-actions"><button type="button" class="btn btn-danger btn-small remove-track" onclick="removeTrack(${n})">Usuń</button></div>
    </div>`; c.appendChild(d);
}
function removeTrack(n){
  const el=document.querySelector('[data-track="'+n+'"]'); if (el){ el.remove(); renumberTracks(); updateTrackCount(); updateRemoveButtons(); }
}
function renumberTracks(){
  document.querySelectorAll('#tracks-container .track-item').forEach((t,i)=>{
    const n=i+1; t.setAttribute('data-track',n);
    const num=t.querySelector('input[type="number"]'); if (num){ num.value=n; num.name=`tracks[${n}][number]`; }
    const ti=t.querySelector('input[name*="[title]"]'); if (ti) ti.name=`tracks[${n}][title]`;
    const du=t.querySelector('input[name*="[duration]"]'); if (du) du.name=`tracks[${n}][duration]`;
    const rm=t.querySelector('.remove-track'); if (rm) rm.setAttribute('onclick',`removeTrack(${n})`);
  });
}
function updateTrackCount(){ const x=document.querySelectorAll('#tracks-container .track-item').length; const el=document.getElementById('trackCount'); if (el) el.textContent=x; }
function updateRemoveButtons(){ const t=document.querySelectorAll('#tracks-container .track-item'); t.forEach(tr=>{ const b=tr.querySelector('.remove-track'); if (b) b.style.display=t.length>1?'inline-block':'none'; }); }

// Submit AJAX
function initializeFormSubmission(){
  const f=document.getElementById('addRecordForm'); if (!f) return;
  f.addEventListener('submit', function(e){
    e.preventDefault(); const btn=document.getElementById('submitBtn'); if (btn){ btn.disabled=true; btn.textContent='Dodawanie...'; }
    const fd=new FormData(f);
    fetch('ajax/add_record_ajax.php',{method:'POST', body:fd})
      .then(r=>r.json())
      .then(d=>{
        if (d.success){
          showMessage(d.message,'success'); f.reset();
          const c=document.getElementById('tracks-container'); c.innerHTML=''; addTrackField(1); updateTrackCount(); updateRemoveButtons(); loadRecordsTable();
        } else { showMessage(d.message,'error'); }
      })
      .catch(()=>showMessage('Wystąpił błąd podczas dodawania płyty','error'))
      .finally(()=>{ if (btn){ btn.disabled=false; btn.textContent='💾 Dodaj płytę'; } });
  });
}
</script>
</body>
</html>
