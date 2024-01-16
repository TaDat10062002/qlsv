$('button.destroy').click(function (e) {
	e.preventDefault();
	var dataUrl = $(this).attr('data-href');
	// Cap nhat gia tri thuoc tinh cho the a 
	$('#exampleModal a').attr('href', dataUrl);
});

$(".form-student-create, .form-student-edit").validate({
	rules: {
		// simple rule, converted to {required:true}
		name: {
			required: true
		},
		// compound rule
		birthday: {
			required: true
		},
		gender: {
			required: true
		}
	},

	messages: {
		// simple rule, converted to {required:true}
		name: {
			required: 'Vui lòng nhập họ tên'
		},
		// compound rule
		birthday: {
			required: 'Vui lòng chọn ngày sinh'
		},
		gender: {
			required: 'Vui lòng chọn giới tính'
		}
	}
});

$(".form-subject-create, .form-subject-edit").validate({
	rules: {
		// simple rule, converted to {required:true}
		name: {
			required: true
		},
		// compound rule
		number_of_credit: {
			required: true,
			range: [1, 10],
			digits: true
		}
	},

	messages: {
		// simple rule, converted to {required:true}
		name: {
			required: 'Vui lòng nhập tên môn học'
		},
		// compound rule
		number_of_credit: {
			required: 'Vui lòng nhập số tín chỉ',
			range: 'Vui lòng nhập con số từ 1 đến 10',
			digits: 'Vui lòng nhập số nguyên'
		}
	}
});

$(".form-register-create").validate({
	rules: {
		// simple rule, converted to {required:true}
		student_id: {
			required: true
		},
		// compound rule
		subject_id: {
			required: true,
		}
	},

	messages: {
		// simple rule, converted to {required:true}
		student_id: {
			required: 'Vui lòng chọn sinh viên'
		},
		// compound rule
		subject_id: {
			required: 'Vui lòng chọn môn học',
		}
	}
});

$(".form-register-edit").validate({
	rules: {
		// simple rule, converted to {required:true}
		score: {
			required: true,
			range: [0, 10]
		},
	},

	messages: {
		// simple rule, converted to {required:true}
		score: {
			required: 'Vui lòng nhập điểm ',
			range: 'Vui lòng nhập điểm từ 0 đến 10'

		},
	}
});