
  let id_emp = $("input[name=id_employee]").val();
  $('#bologna-list a').on('click', function(e) {
    e.preventDefault()
    $(this).tab('show')
  });

  loadExp();
  loadEdu();
  loadSkill();
  loadFam();

  function refreshdata() {
    // $('#name').val('');
    // $('#desc_skill').val('');
    $('#tableExp').DataTable().clear().destroy();
    $('#tableEdu').DataTable().clear().destroy();
    $('#tableSkill').DataTable().clear().destroy();
    $('#tableFam').DataTable().clear().destroy();
    loadExp();
    loadEdu();
    loadSkill();
    loadFam();
  }

  function closing() {
    $('#form').modal('hide');
  }

  function loadExp() {
    $('#tableExp').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeexp') }}/" + id_emp,
      columns: [{
          data: 'company',
          name: 'company'
        },
        {
          data: 'job_title',
          name: 'job_title'
        },
        {
          data: 'from_date',
          name: 'from_date'
        },
        {
          data: 'to_date',
          name: 'to_date'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  function loadEdu() {
    $('#tableEdu').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeedu') }}/" + id_emp,
      columns: [{
          data: 'level',
          name: 'level'
        },
        {
          data: 'school',
          name: 'school'
        },
        {
          data: 'major',
          name: 'major'
        },
        {
          data: 'year',
          name: 'year'
        },
        {
          data: 'gpa',
          name: 'gpa'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  function loadSkill() {
    $('#tableSkill').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeskill') }}/" + id_emp,
      columns: [{
          data: 'skill',
          name: 'skill'
        },
        {
          data: 'desc',
          name: 'desc'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }
  function loadFam() {
    $('#tableFam').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeefam') }}/" + id_emp,
      columns: [{
          data: 'name',
          name: 'name'
        },
        {
          data: 'relationship',
          name: 'relationship'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({

    })
  })
  $(".save-data-exp").click(function(event) {
    event.preventDefault();

    let company = $("input[name=company_exp]").val();
    let job_title = $("input[name=job_title_exp]").val();
    let from_date = $("input[name=from_date_exp]").val();
    let to_date = $("input[name=to_date_exp]").val();

    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeexp') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        company: company,
        job_title: job_title,
        from_date: from_date,
        to_date: to_date,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()

  });
  $(".save-data-edu").click(function(event) {
    event.preventDefault();

    let level = $("select[name=level]").val();
    let school = $("input[name=school]").val();
    let major = $("input[name=major]").val();
    let year = $("input[name=year]").val();
    let gpa = $("input[name=gpa]").val();


    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeedu') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        level: level,
        school: school,
        major: major,
        year: year,
        gpa: gpa,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()

  });
  $(".save-data-skill").click(function(event) {
    event.preventDefault();

    let skill = $("select[name=skill]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeskill') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        skill: skill,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()

  });
  $(".save-data-fam").click(function(event) {
    event.preventDefault();

    let name = $("input[name=fam_name]").val();
    let relationship = $("input[name=fam_relation]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeefam') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        name: name,
        relationship: relationship,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()

  });
  $(".save-data-personal").click(function(event) {
    event.preventDefault();

    let first_name = $("input[name=first_name]").val();
    let middle_name = $("input[name=middle_name]").val();
    let last_name = $("input[name=last_name]").val();
    let emp_other_id = $("input[name=emp_other_id]").val();
    let emp_birth = $("input[name=emp_birth]").val();
    let emp_place_birth = $("input[name=emp_place_birth]").val();
    let emp_marital = $("select[name=emp_marital]").val();
    let emp_gender = $("select[name=emp_gender]").val();
    let emp_nationality = $("select[name=emp_nationality]").val();
    let emp_drive_license = $("input[name=emp_drive_license]").val();
    let emp_blood_grp = $("select[name=emp_blood_grp]").val();
    let emp_hobbies = $("input[name=emp_hobbies]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('update_personal') }}",
      type: "POST",
      data: {
        id: id_emp,
        first_name: first_name,
        last_name: last_name,
        middle_name: middle_name,
        emp_other_id: emp_other_id,
        emp_birth: emp_birth,
        emp_place_birth: emp_place_birth,
        emp_marital: emp_marital,
        emp_gender: emp_gender,
        emp_nationality: emp_nationality,
        emp_drive_license: emp_drive_license,
        emp_blood_grp: emp_blood_grp,
        emp_hobbies: emp_hobbies,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()
    location.reload();

  });
  $(".save-data-job").click(function(event) {
    event.preventDefault();

    let emp_join_date = $("input[name=emp_join_date]").val();
    let emp_date_permanency = $("input[name=emp_date_permanency]").val();
    let bpjs_kes = $("input[name=bpjs_kes]").val();
    let bpjs_kej = $("input[name=bpjs_kej]").val();
    let emp_job_title = $("select[name=emp_job_title]").val();
    let emp_status = $("select[name=emp_status]").val();
    let emp_job_ctg = $("select[name=emp_job_ctg]").val();
    let emp_sub_unit = $("select[name=emp_sub_unit]").val();
    let emp_work_shift = $("select[name=emp_work_shift]").val();
    let emp_effective_date = $("input[name=emp_effective_date]").val();
    let emp_contract_start = $("input[name=emp_contract_start]").val();
    let emp_contract_end = $("input[name=emp_contract_end]").val();
    let emp_location = $("select[name=emp_location]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('update_job') }}",
      type: "POST",
      data: {
        id: id_emp,
        emp_join_date: emp_join_date,
        emp_date_permanency: emp_date_permanency,
        emp_job_title: emp_job_title,
        emp_status: emp_status,
        emp_job_ctg: emp_job_ctg,
        emp_sub_unit: emp_sub_unit,
        bpjs_kes:bpjs_kes,
        bpjs_kej:bpjs_kej,
        emp_work_shift: emp_work_shift,
        emp_effective_date: emp_effective_date,
        emp_contract_start: emp_contract_start,
        emp_contract_end: emp_contract_end,
        emp_location: emp_location,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()
    location.reload();

  });
  $(".save-data-contact").click(function(event) {
    event.preventDefault();

    let address1 = $("textarea[name=address1]").val();
    let address2 = $("textarea[name=address2]").val();
    let city = $("input[name=city]").val();
    let province = $("input[name=province]").val();
    let zipcode = $("input[name=zipcode]").val();
    let hp = $("input[name=hp]").val();
    let wa = $("input[name=wa]").val();
    let home_tlp = $("input[name=home_tlp]").val();
    let email = $("input[name=email]").val();
    let work_email = $("input[name=work_email]").val();
    let emc_contact_name = $("input[name=emc_contact_name]").val();
    let emc_contact_phone = $("input[name=emc_contact_phone]").val();
    let relationship = $("input[name=relationship]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeecontact') }}",
      type: "POST",
      data: {
        id: id_emp,
        address1: address1,
        address2: address2,
        city: city,
        province: province,
        zipcode: zipcode,
        hp: hp,
        wa: wa,
        home_tlp: home_tlp,
        email: email,
        work_email: work_email,
        emc_contact_name: emc_contact_name,
        emc_contact_phone: emc_contact_phone,
        relationship: relationship,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });
    refreshdata()
    location.reload();

  });
  $(".save-data-img").click(function(event) {
    event.preventDefault();

    let emp_pic_new = $("input[name=emp_pic_new]").val();
    let emp_pic = $("input[name=emp_pic]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    console.log(emp_pic_new)
    $.ajax({
      url: "{{ route('update_img') }}",
      enctype: 'multipart/form-data',
      type: "POST",
      data: {
        id: id_emp,
        emp_pic_new: emp_pic_new,
        emp_pic: emp_pic,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
    });



  });

  function delExp($id) {
    var id = $id;
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeexp') }}/" + id,
      type: "get",
    });
    refreshdata();
  }

  function delEdu($id) {
    var id = $id;
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeedu') }}/" + id,
      type: "get",
    });
    refreshdata();
  }

  function delSkill($id) {
    var id = $id;
    console.log(id);
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeskill') }}/" + id,
      type: "get",
    });
    refreshdata();
  }
  function delFam($id) {
    var id = $id;
    console.log(id);
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeefam') }}/" + id,
      type: "get",
    });
    refreshdata();
  }

  $(function() {

    $(".type").on("change", function() {
      var type = $(this).find('option:selected').attr('data');
      console.log(type);

      if (type != 0) {
        document.getElementById("supervisor").disabled = false;
      } else {
        document.getElementById("supervisor").disabled = true;
      }
    })
  })

  function initImageUpload(box) {
    let uploadField = box.querySelector(".image-upload");

    uploadField.addEventListener("change", getFile);

    function getFile(e) {
      let file = e.currentTarget.files[0];
      checkType(file);
    }

    function previewImage(file) {
      let thumb = box.querySelector(".js--image-preview"),
        reader = new FileReader();

      reader.onload = function() {
        thumb.style.backgroundImage = "url(" + reader.result + ")";
      };
      reader.readAsDataURL(file);
      thumb.className += " js--no-default";
    }

    function checkType(file) {
      let imageType = /image.*/;
      if (!file.type.match(imageType)) {
        throw "Datei ist kein Bild";
      } else if (!file) {
        throw "Kein Bild gewählt";
      } else {
        previewImage(file);
      }
    }
  }

  // initialize box-scope
  var boxes = document.querySelectorAll(".box");

  for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
  }

  /// drop-effect
  function initDropEffect(box) {
    let area,
      drop,
      areaWidth,
      areaHeight,
      maxDistance,
      dropWidth,
      dropHeight,
      x,
      y;

    // get clickable area for drop effect
    area = box.querySelector(".js--image-preview");
    area.addEventListener("click", fireRipple);

    function fireRipple(e) {
      area = e.currentTarget;
      // create drop
      if (!drop) {
        drop = document.createElement("span");
        drop.className = "drop";
        this.appendChild(drop);
      }
      // reset animate class
      drop.className = "drop";

      // calculate dimensions of area (longest side)
      areaWidth = getComputedStyle(this, null).getPropertyValue("width");
      areaHeight = getComputedStyle(this, null).getPropertyValue("height");
      maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

      // set drop dimensions to fill area
      drop.style.width = maxDistance + "px";
      drop.style.height = maxDistance + "px";

      // calculate dimensions of drop
      dropWidth = getComputedStyle(this, null).getPropertyValue("width");
      dropHeight = getComputedStyle(this, null).getPropertyValue("height");

      // calculate relative coordinates of click
      // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
      x = e.pageX - this.offsetLeft - parseInt(dropWidth, 10) / 2;
      y = e.pageY - this.offsetTop - parseInt(dropHeight, 10) / 2 - 30;

      // position drop and animate
      drop.style.top = y + "px";
      drop.style.left = x + "px";
      drop.className += " animate";
      e.stopPropagation();
    }
  }
