document.addEventListener('DOMContentLoaded', () => {
    (function () {

        const validate = (value, id) => {

            let errMessage = {
                NAME: 'Поле обязательно для заполнения',
                PERSONAL_BIRTHDATE: 'Не верно указан формат дд.мм.ггг',
                PERSONAL_PHONE: 'Не верно указан формат +7(999)999-99-99 / 79999999999'
            };


            // (^[\+][0-9]{1}[\(][0-9]{3}[\)][0-9]{3}[-| ][0-9]{2}[-| ][0-9]{2})  -> +7(999)999 99 99 || +7(999)999-99-99
            // (^[8|7]{1}[0-9]{10}) -> 79999999999 || 89999999999
            // (^\d{1,2}\.\d{1,2}\.\d{2,4}) -> 25.05.18 || 25.05.2018
            let arrRegexp =  [
                /^[\+][0-9]{1}[\(][0-9]{3}[\)][0-9]{3}[-| ][0-9]{2}[-| ][0-9]{2}/gm,
                /^[8|7]{1}[0-9]{10}/gm,
                /^\d{1,2}\.\d{1,2}\.\d{2,4}/gm
            ], isValid = false, resMess;

            if (id === 'NAME') {
                isValid = value.length > 0;
            } else {

                for(let i = 0; i < arrRegexp.length; i++) {

                    if (arrRegexp[i].test(value)) {
                        isValid = true;
                    }
                }
            }

            if (!isValid) {
                resMess = errMessage[id];
            }

            return {id, isValid, resMess}
        };

        let form = document.getElementById('update_user_data'),
            formElements = [].slice.call(form.elements),
            errors = {}, countErr = 0;

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            formElements.map(item => {
                if (item.tagName === 'INPUT' && item.type === 'text') {
                    let {id, isValid, resMess} = validate(item.value, item.id);
                    let elP = document.createElement('span');
                    elP.innerHTML = resMess;

                    if (!isValid && !errors[id]) {

                        countErr++;
                        errors[id] = form.insertBefore(elP, form[id].nextSibling);
                    } else if (isValid && errors[id]){

                        countErr--;
                        form.removeChild(errors[id]) && delete errors[id];
                    }
                }
            });

           countErr === 0 && form.submit();
        })
    })();
});