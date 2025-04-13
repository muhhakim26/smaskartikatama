// Editor Js Start
document.addEventListener('DOMContentLoaded', () => {
    const FontAttributor = Quill.import('formats/font');
    FontAttributor.whitelist = ['poppins'];
    Quill.register(FontAttributor, true);
    // const List = Quill.import('formats/list-container');
    // List.className = 'list-decimal';
    // Quill.register(List, true);
    console.log(Quill.imports);

    let quill = new Quill('#editor', {
        modules: {
            toolbar: '#toolbar-container',
        },
        theme: 'snow',
    });

    if (document.getElementById('deskripsi')) {
        let deskripsi = document.getElementById('deskripsi');
        // Cek apakah ada data sebelumnya (edit mode)
        if (quill.root.innerHTML.trim() !== '') {
            deskripsi.value = quill.getSemanticHTML();
        }

        quill.on('text-change', function () {
            deskripsi.value = quill.getSemanticHTML();
        });

        deskripsi.addEventListener('input', function () {
            quill.root.innerHTML = deskripsi.value;
        });
    }
});
// Editor Js End

// =============================== Upload Single Image js start here ================================================
const fileInput = document.getElementById('upload-file');
const imagePreview = document.getElementById('uploaded-img__preview');
const uploadedImgContainer = document.querySelector('.uploaded-img');
const removeButton = document.querySelector('.uploaded-img__remove');
const uploadLabel = document.querySelector('.upload-file'); // Ambil elemen label

// Cek apakah ada gambar yang sudah diunggah sebelumnya (edit mode)
if (imagePreview) {
    if (imagePreview.src && imagePreview.src !== window.location.origin + '/') {
        uploadedImgContainer.classList.remove('d-none'); // Tampilkan preview gambar
        uploadLabel.classList.add('d-none'); // Sembunyikan label upload
    }
}

if (fileInput) {
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            uploadedImgContainer.classList.remove('d-none');
            uploadLabel.classList.add('d-none');
        }
    });
}
if (removeButton) {
    removeButton.addEventListener('click', () => {
        imagePreview.src = '';
        uploadedImgContainer.classList.add('d-none');
        uploadLabel.classList.remove('d-none');
        fileInput.value = '';
    });
}
// =============================== Upload Single Image js End here ================================================
