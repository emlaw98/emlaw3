const cityDropdown = document.getElementById('city_dropdown');
if(cityDropdown.length){
    cityDropdown.addEventListener('change', function(){
        let cityID = cityDropdown.value;
        $.ajax({
            url: '/location/district/ajax',
            type: 'GET',
            data:{
                province_id: cityID
            },
            dataType: 'json',
            beforeSend: function(){
                $('#district_dropdown').empty();
                $('#district_dropdown').prop('disabled', true);
                $('#ward_dropdown').empty();
                $('#ward_dropdown').prop('disabled', true);
            },
            success: function(json){
                $('#district_dropdown').prop('disabled', false);
                $('#district_dropdown').append(json.data.firstOption)
                json.data.districts.forEach(element => {
                    $('#district_dropdown').append('<option value="'+ element.id +'">'+ element.name +'</option>')
                });
            }
        })
    })
}

const districtDropdown = document.getElementById('district_dropdown');
if(districtDropdown.length){
    districtDropdown.addEventListener('change', function(){
        let districtID = districtDropdown.value;
        $.ajax({
            url: '/location/ward/ajax',
            type: 'GET',
            data: {
                'district_id': districtID
            },
            dataType: 'json',
            beforeSend: function(){
                $('#ward_dropdown').empty();
                $('#ward_dropdown').prop('disabled', true);
            },
            success: function(json){
                $('#ward_dropdown').prop('disabled', false);
                json.data.forEach(element => {
                    $('#ward_dropdown').append('<option value="'+ element.id +'">'+ element.name +'</option>')
                });
            }
        })
    })
}
