$('#btnDeleteSubscription').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    request = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
    });


    request.done(function (data, textStatus, qXHR) {
        if(textStatus === 'success'){
            checked.closest('tr').remove();
            alert("Subscription is deleted");
        } else {
            alert("Subscription is not deleted");
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});

$('#addSubscriptionForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Subscription is added :)'); 
            location.reload(true);
        } else {
            alert('Subscription is not added :(');
            location.reload(true);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});

$('#btnEditSubscription').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    alert(checked.val());
    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        $('#subscriptionNameId').val(response[0]['name']);
        $('#maximumNumberOfAccountsId').val(response[0]['maximumNumberOfAccounts'].trim());
        $('#subscriptionPriceId').val(response[0]['price'].trim());
        $('#id').val(checked.val());
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        alert('Error occurred: ' + textStatus, errorThrown);        
    });

});

$('#editSubscriptionForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();

    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Subscription is edited!'); 
            location.reload(true);
        } else {
            alert('Subscription is not edited!');
            location.reload(true);
        }
    });
    
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
});



