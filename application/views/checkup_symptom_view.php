<body>

<div class="hero-section hero-title set-bg" data-setbg="<?=base_url()?>public/img/bg/Shiny-bg.svg">
    <div class="container h-100">
      <div class="hero-content text-white">
        <div class="row">
          <div class="title">
            <h2>Symptom Checkup</h2>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row justify-content-center pt-5">
  <div class="col-8">
    <form class="form p-4 my-5 justify-content-center align-items-center" style="height: 65vh;" id="Loginform" action="<?=base_url()?>CheckupResult/addNewCheckup" method="post">

        <label for="selected_values">Select Symptoms (multiple):</label>
        <select name="userSymptom[]" id="selected_values" multiple required>
            <?php
            $symptoms = [
               'nodal_skin_eruptions',
               'shivering',
               'joint_pain',
               'stomach_pain',
               'muscle_wasting',
               'spotting_urination',
               'fatigue',
               'patches_in_throat',
               'cough',
               'sunken_eyes',
               'breathlessness',
               'sweating',
               'dehydration',
               'indigestion',
               'dark_urine',
               'pain_behind_the_eyes',
               'mild_fever',
               'yellowing_of_eyes',
               'malaise',
               'phlegm',
               'fast_heart_rate',
               'irritation_in_anus',
               'neck_pain',
               'cramps',
               'slurred_speech',
               'muscle_weakness',
               'unsteadiness',
               'continuous_feel_of_urine',
               'passage_of_gases',
               'toxic_look_(typhos)',
               'depression',
               'irritability',
               'muscle_pain',
               'altered_sensorium',
               'abnormal_menstruation',
               'dischromic _patches',
               'watering_from_eyes',
               'increased_appetite',
               'family_history',
               'mucoid_sputum',
               'lack_of_concentration'
            ];



            foreach ($symptoms as $symptom) {
              $symptomText = str_replace('_', ' ', $symptom);
              echo '<option value="' . $symptom . '">' . $symptomText . '</option>';
            }
            ?>
        </select>
        <button type="submit" value="Run Model" class="btn btn-dark btn-block">Submit</button>
    <p>Didn't found your symptom?<a href="<?=base_url()?>Appointment"> Book an appointment with doctor now</p></a>
    <a href="<?=base_url()?>CheckupHistory">
    <button type="button" class="btn btn-info"><i class='bx bx-history nav_icon'></i> View Checkup History</button>
    </a>
  </div>
    </form>
</div>

<script>
    new MultiSelectTag('selected_values')  // id
    function MultiSelectTag(e, t = { shadow: !1, rounded: !0 }) {
  var n = null,
    d = null,
    l = null,
    a = null,
    s = null,
    i = null,
    o = null,
    c = null,
    r = null,
    u = null,
    p = null,
    v = null,
    m = new DOMParser();

  function h(e = null) {
    for (const t of ((v.innerHTML = ''), d))
      if (t.selected) !w(t.value) && f(t);
      else {
        const n = document.createElement('li');
        n.innerHTML = t.label;
        n.dataset.value = t.value;
        e && t.label.toLowerCase().startsWith(e.toLowerCase())
          ? v.appendChild(n)
          : e || v.appendChild(n);
      }
  }

  function f(e) {
    const t = document.createElement('div');
    t.classList.add('item-container');

    const n = document.createElement('div');
    n.classList.add('item-label');
    n.innerHTML = e.label;
    n.dataset.value = e.value;

    const l = new DOMParser().parseFromString(
      '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="item-close-svg">\n' +
        '                <line x1="18" y1="6" x2="6" y2="18"></line>\n' +
        '                <line x1="6" y1="6" x2="18" y2="18"></line>\n' +
        '                </svg>',
      'image/svg+xml'
    ).documentElement;

    l.addEventListener('click', (t) => {
      d.find((t) => t.value == e.value).selected = !1;
      g(e.value);
      h();
      E();
    });

    t.appendChild(n);
    t.appendChild(l);
    o.append(t);
  }

  function L() {
    for (const e of v.children)
      e.addEventListener('click', (e) => {
        d.find((t) => t.value == e.target.dataset.value).selected = !0;
        r.value = null;
        h();
        E();
        r.focus();
      });
  }

  function w(e) {
    for (const t of o.children)
      if (!t.classList.contains('input-body') && t.firstChild.dataset.value == e) return !0;
    return !1;
  }

  function g(e) {
    for (const t of o.children)
      if (!t.classList.contains('input-body') && t.firstChild.dataset.value == e)
        o.removeChild(t);
  }

  function E() {
    for (let e = 0; e < d.length; e++) n.options[e].selected = d[e].selected;
  }

  n = document.getElementById(e);

  (function () {
    d = [...n.options].map((e) => ({
      value: e.value,
      label: e.label,
      selected: e.selected,
    }));
    n.classList.add('hidden');
    (l = document.createElement('div')).classList.add('mult-select-tag');
    (a = document.createElement('div')).classList.add('wrapper');
    (i = document.createElement('div')).classList.add('body');
    t.shadow && i.classList.add('shadow');
    t.rounded && i.classList.add('rounded');
    (o = document.createElement('div')).classList.add('input-container');
    (r = document.createElement('input')).classList.add('input');
    r.placeholder = `${t.placeholder || 'Search...'}`;
    (c = document.createElement('inputBody')).classList.add('input-body');
    c.append(r);
    i.append(o);
    (s = document.createElement('div')).classList.add('btn-container');
    (u = document.createElement('button')).type = 'button';
    s.append(u);
    const e = m.parseFromString(
      '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n' +
        '            <polyline points="18 15 12 21 6 15"></polyline></svg>',
      'image/svg+xml'
    ).documentElement;
    u.append(e);
    i.append(s);
    a.append(i);
    (p = document.createElement('div')).classList.add('drawer', 'hidden');
    t.shadow && p.classList.add('shadow');
    t.rounded && p.classList.add('rounded');
    p.append(c);
    v = document.createElement('ul');
    p.appendChild(v);
    l.appendChild(a);
    l.appendChild(p);
    n.nextSibling ? n.parentNode.insertBefore(l, n.nextSibling) : n.parentNode.appendChild(l);
  })();

  h();
  L();
  E();

  u.addEventListener('click', () => {
    p.classList.contains('hidden') && (h(), L(), p.classList.remove('hidden'), r.focus());
  });

  r.addEventListener('keyup', (e) => {
    h(e.target.value);
    L();
  });

  r.addEventListener('keydown', (e) => {
    if ('Backspace' === e.key && !e.target.value && o.childElementCount > 1) {
      const e = i.children[o.childElementCount - 2].firstChild;
      d.find((t) => t.value == e.dataset.value).selected = !1;
      g(e.dataset.value);
      E();
    }
  });

  window.addEventListener('click', (e) => {
    l.contains(e.target) || p.classList.add('hidden');
  });
}


</script>
</body>

<style>
                                                                                   
body {font-family: Arial, Helvetica, sons-serif;}
* {box-sizing: border-box}

.hero-title
{
  height:270px;
  overflow:hidden;
}


.card{
  background: white;
  width: 400px;
  height: 500px;
  border:none;
}
.btr{

  border-top-right-radius: 5px !important;
}
.btl{

  border-top-left-radius: 5px !important;
}
.btn-dark {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}
.btn-dark:hover {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}
.nav-pills{

  display:table !important;
  width:100%;
}
.nav-pills .nav-link {
    border-radius: 0px;
        border-bottom: 1px solid #0d6efd40;

}
.nav-item{
      display: table-cell;
       background: #0d6efd2e;
}

.form{

  padding: 10px;
      height: 300px;
}
.form input{

  margin-bottom: 12px;
  border-radius: 3px;
}
.form input:focus{

  box-shadow: none;
}
.form button{

  margin-top: 20px;
}
/*/////////////////////////////////////////////////////////////////
*/

/* General Styles */
.mult-select-tag {
  display: flex;
  width: 100%;
  flex-direction: column;
  align-items: center;
  position: relative;
  font-family: Verdana, sans-serif;
}

/* Shadow Styles */
.mult-select-tag {
  --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
  --tw-shadow-color: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
  --border-color: rgb(218, 221, 224);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

/* Container Styles */
.mult-select-tag .wrapper {
  width: 100%;
}

.mult-select-tag .body {
  display: flex;
  border: 1px solid var(--border-color);
  background: #fff;
  min-height: 2.15rem;
  width: 100%;
  min-width: 14rem;
}

/* Input Styles */
.mult-select-tag .input-container {
  display: flex;
  flex-wrap: wrap;
  flex: 1 1 auto;
  padding: 0.1rem;
}

.mult-select-tag .input-body {
  display: flex;
  width: 100%;
}

.mult-select-tag .input {
  flex: 1;
  background: 0 0;
  border-radius: 0.25rem;
  padding: 0.45rem;
  margin: 10px;
  color: #2d3748;
  outline: 0;
  border: 1px solid var(--border-color);
}

/* Button Styles */
.mult-select-tag .btn-container {
  color: #e2ebf0;
  padding: 0.5rem;
  display: flex;
  border-left: 1px solid var(--border-color);
}

.mult-select-tag button {
  cursor: pointer;
  width: 100%;
  color: #718096;
  outline: 0;
  height: 100%;
  border: none;
  padding: 0;
  background: 0 0;
  background-image: none;
  -webkit-appearance: none;
  text-transform: none;
  margin: 0;
}

.mult-select-tag button:first-child {
  width: 1rem;
  height: 90%;
}

/* Drawer Styles */
.mult-select-tag .drawer {
  position: absolute;
  background: #fff;
  max-height: 15rem;
  z-index: 40;
  top: 98%;
  width: 100%;
  overflow-y: scroll;
  border: 1px solid var(--border-color);
  border-radius: 0.25rem;
}

/* List Styles */
.mult-select-tag ul {
  list-style-type: none;
  padding: 0.5rem;
  margin: 0;
}

.mult-select-tag ul li {
  padding: 0.5rem;
  border-radius: 0.25rem;
  cursor: pointer;
}

.mult-select-tag ul li:hover {
  background: rgb(243 244 246);
}

/* Item Styles */
.mult-select-tag .item-container {
  display: flex;
  justify-content: center;
  align-items: center;
  color: #2c7a7b;
  padding: 0.2rem 0.4rem;
  margin: 0.2rem;
  font-weight: 500;
  background: #e6fffa;
  border: 1px solid #81e6d9;
  border-radius: 9999px;
}

.mult-select-tag .item-label {
  max-width: 100%;
  line-height: 1;
  font-size: 0.75rem;
  font-weight: 400;
  flex: 0 1 auto;
  color: #2c7a7b;
}

.mult-select-tag .item-close-container {
  display: flex;
  flex: 1 1 auto;
  flex-direction: row-reverse;
}

.mult-select-tag .item-close-svg {
  width: 1rem;
  margin-left: 0.5rem;
  height: 1rem;
  cursor: pointer;
  border-radius: 9999px;
  display: block;
}

/* Hidden Class */
.hidden {
  display: none;
}

/* Rounded Border */
.mult-select-tag .rounded {
  border-radius: 0.375rem;
}

</style>


