$(document).ready(() => {
    document.querySelectorAll('.required').forEach(item => {
        item.addEventListener('blur', event => {
            if (event.currentTarget.value !== '') {
                event.currentTarget.classList.add('is-valid');
                event.currentTarget.classList.remove('is-invalid');
            } else {
                event.currentTarget.classList.remove('is-valid');
                event.currentTarget.classList.add('is-invalid');
            }
        });
    });

    $('#customerBirthDate').mask('00/00/0000');
    $('.maskCPF').mask('000.000.000-00');
    $('#customerBirthDate').datepicker();
    $('#customerBirthDate').datepicker('option', {
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: "1920:2030"
    });
    $('#customerBirthDate').datepicker($.datepicker.regional["pt-BR"]);

    $('.delete-customer').on('click', function () {
        Swal.fire({
            title: 'Desejar realmente excluir esse registro?',
            html: `<div><strong>Você não poderá desfazer essa alteração!</strong></div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/customer/deleteCustomer',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: $(this).data('code')
                    }
                }).done(function (data) {
                    let icon = data.error ? 'warning' : 'success';
                    Swal.fire({
                        position: 'center',
                        icon: icon,
                        title: data.message,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/customer';
                        }
                    });
                }).fail(function () {
                    console.log('deu ruim');
                });
            }
        });
    });

    $('#btnUpdate').on('click', () => {
        const form = $('#formUpdateCustomer');
        if (formValidate(form[0])) {
            const data = form.serializeArray();
            $.ajax({
                url: '/customer/updateCustomer',
                type: 'POST',
                dataType: 'json',
                data: data,
            }).done(function (response) {
                let icon = response.erro ? 'warning' : 'success';
                Swal.fire({
                    position: 'center',
                    icon: icon,
                    title: response.message,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed && !response.erro) {
                        window.location.href = '/customer';
                    }
                });
            }).fail(function () {
                console.log('deu ruim');
            });
        }
    });

    $('#btnRegister').on('click', () => {
        const form = $('#formRegisterCustomer');
        if (formValidate(form[0])) {
            const data = form.serializeArray();
            $.ajax({
                url: '/customer/registerCustomer',
                type: 'POST',
                dataType: 'json',
                data: data,
            }).done(function (response) {
                let icon = response.erro ? 'warning' : 'success';
                Swal.fire({
                    position: 'center',
                    icon: icon,
                    title: response.message,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed && !response.erro) {
                        window.location.href = '/customer';
                    }
                });
            }).fail(function () {
                console.log('Erro ao registrar usuário');
            });
        }
    });

    $('#customerCep').on('blur', () => {
        let cep = $('#customerCep').val().replace(/\D/g, '');

        if (cep != "") {
            let validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                $("#customerAddress").val("...");
                $("#customerNbh").val("...");
                $("#customerCity").val("...");
                $("#customerState").val("...");
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        $("#customerAddress").val(dados.logradouro);
                        $("#customerNbh").val(dados.bairro);
                        $("#customerCity").val(dados.localidade);
                        $("#customerState").val(dados.uf);
                        loadingCities();
                    } else {
                        clearFormCep();
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'CEP não encontrado!',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        });
                    }
                });
            } else {
                clearFormCep();
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Formato de CEP inválido!',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                });
            }
        } else {
            clearFormCep();
        }
    });

    $('#customerCPF').on('blur', (event) => {
        if (event.target.value.length && !validateCPF(event.target.value.match(/\d+/gi).join(''))) {
            event.target.value = '';
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'CPF Inválido!',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        }
    });
});

function clearFormCep() {
    $("#customerAddress").val("");
    $("#customerNbh").val("");
    $("#customerCity").val("");
    $("#customerState").val("");
}

function validateCPF(cpf) {
    if (typeof cpf !== "string") return false;
    cpf = cpf.replace(/[\s.-]*/igm, '')
    if (
        !cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999" 
    ) {
        return false;
    }

    var sum;
    var rest;
    sum = 0;
    if (cpf == "00000000000") return false;

    for (i=1; i<=9; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (11 - i);
    rest = (sum * 10) % 11;

    if ((rest == 10) || (rest == 11))  rest = 0;
    if (rest != parseInt(cpf.substring(9, 10)) ) return false;

    sum = 0;
    for (i = 1; i <= 10; i++) sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i);
    rest = (sum * 10) % 11;

    if ((rest == 10) || (rest == 11))  rest = 0;
    if (rest != parseInt(cpf.substring(10, 11) ) ) return false;
    return true;
}