document.addEventListener('DOMContentLoaded', () => {
    (function () {

        let fileInput =  document.getElementById('file'),
            formFile = document.getElementById('file_form'),
            linkElem;

        formFile.addEventListener('submit', (e) => {
            e.preventDefault();

            if (!linkElem) {
                formFile.submit();
            }
        });

        fileInput.addEventListener('change', (e) => {

            if (!fileInput.files[0]) return;

            let file = fileInput.files[0],
                parts = file.type.split('/')[1];
            if (parts === 'jpeg' || parts === 'pdf') {

                if (linkElem) {
                    formFile.removeChild(linkElem);
                    linkElem = null;
                }

            } else {

                let elemSpan = document.createElement('span');
                elemSpan.innerText = "Допустимые форматы файлов 'jpg/pdf'";

                if (!linkElem) {

                    linkElem = formFile.insertBefore(elemSpan, fileInput.nextSibling);
                }
            }


        });

    })()
});