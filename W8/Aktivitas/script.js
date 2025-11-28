const form = document.getElementById('form');
const tableBody = document.getElementById('tabelBody');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const namaInput = document.querySelector("#Nama.input input");
    const umurInput = document.querySelector("#Umur.input input");


    const tr=document.createElement('tr');
    const tdNama=document.createElement('td');

    tdNama.innerText=namaInput.value;
    tdNama.style.padding='10px';


    const tdUmur=document.createElement('td');

    tdUmur.innerText=umurInput.value;
    tdUmur.style.padding='10px';

    tr.appendChild(tdNama);
    tr.appendChild(tdUmur);

    tableBody.appendChild(tr);

    form.reset();
});