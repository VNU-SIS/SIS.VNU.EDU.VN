<?php
return [
    'welcome' => 'Chào mừng bạn đến với Website!',
    'role' => [
        'teacher' => 'Giảng Viên',
        'teacher_post' => 'Giảng Viên + Bài viết',
        'sp_admin' => 'Super Admin',
    ],
    'sex' => [
        'male' => "Nam",
        'female' => 'Nữ',
    ],
    'user' => [
        'name' => 'Người dùng',
        'label' => [
            'title_form' => 'Danh sách người dùng',
            'name' => 'Họ và tên',
            'email' => 'Đia chỉ email',
            'password' => 'Mật khẩu',
            'role' => 'Quyền hạn',
            'user_list' => 'Danh sách nhân sự',
            'option' => 'Tùy chọn',
            'department' => 'Khoa',
            'info' => 'Thông tin khác',
            'phone' => 'Số điện thoại',
            'facebook' => 'Facebook',
            'sex' => 'Giới tính',
            'profile' => 'Cập nhật thông tin',
            'date_of_birth' => 'Ngày sinh',
            'structure' => 'Bộ phận',
            'create' => 'Tạo người dùng',
            'edit' => 'Sửa người dùng',
            'position' => 'Chức vụ',
            'list_sidebar' => 'Danh sách người dùng',
            'create_sidebar' => 'Đăng ký người dùng',
        ],
        'placeholder' => [
            'name' => 'Nhập họ và tên',
            'email' => 'Nhập đia chỉ email',
            'password' => 'Nhập mật khẩu',
            'phone' => 'Nhập số điện thoại',
            'role' => 'Chọn quyền hạn',
            'facebook' => 'Nhập link facebook',
        ],
        'button' => [
            'submit' => 'Lưu',
            'reset' => 'Reset',
        ],
    ],
    'departments' => [
        'name' => 'Khoa',
        'label' => [
            'title_form' => 'Danh sách khoa',
            'name' => 'Tên khoa',
            'department_list' => 'Danh sách khoa',
            'option' => 'Tùy chọn'
        ],
        'placeholder' => [
            'name' => 'Nhập tên khoa',
        ],
        'button' => [
            'submit' => 'Lưu',
            'reset' => 'Reset',
        ],
    ],
    'category' => [
        'name' => 'Danh mục',
        'label' => [
            'name' => 'Tên danh mục',
            'parent' => 'Danh mục cha',
            'description' => 'Mô tả',
            'create' => 'Tạo danh mục',
            'edit' => 'Chỉnh sửa danh mục',
            'list' => 'Danh sách danh mục'
        ],
        'validate' => [
            'name_required' => 'Tên trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!'
        ]
    ],
    'post' => [
        'name' => 'Bài viết',
        'label' => [
            'title' => 'Tiêu đề',
            'thumbnail' => 'Thumnail',
            'category' => 'Danh mục',
            'content' => 'Nội dung',
            'create' => 'Tạo bài viết',
            'edit' => 'Chỉnh sửa bài viết',
            'list' => 'Danh sách bài viết',
            'event_at' => 'Ngày diễn ra',
            'updated_at' => 'Ngày cập nhật',
        ],
        'validate' => [
            'title_required' => 'Tiêu đề trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!',
            'category_required' => 'Danh mục trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!',
            'thumbnail_required' => 'Thumbail trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!',
            'thumbnail_image' => 'Thumbnail phải là một ảnh!!!',
            'content_required' => 'Nội dung trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!',
        ]
    ],
    'gallery' => [
        'name' => 'Thư viện ảnh',
        'label' => [
            'title' => 'Tiêu đề',
            'thumbnail' => 'Thumnail',
            'create' => 'Tạo album',
            'edit' => 'Chỉnh sửa album',
            'list' => 'Danh sách album',
            'upload' => 'Tải ảnh lên',
            'info' => 'Thông tin'
        ],
        'validate' => [
            'title_required' => 'Tiêu đề trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!',
            'thumbnail_required' => 'Thumbail trống!!! Bạn vui lòng nhập đầy đủ dữ liệu!!!',
            'thumbnail_image' => 'Thumbnail phải là một ảnh!!!'
        ]
    ],
    'youtube' => [
      'name' => 'Youtube',
      'label' => [
        'link' => 'URL video',
        'edit' => 'Cập nhật youtube'
      ]
    ],
    'options' => 'Tùy chọn',
    'created_by' => 'Người tạo',
    'structure_users' => [
        'title' => 'Cơ cấu tổ chức',
    ],
];