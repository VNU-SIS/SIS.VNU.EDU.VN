<div class="header">
  <div class="bg-vnu-blue">
    <div class="container text-right py-2">
      <ul class="mb-0" style="font-size: 11px">
        <li class="d-inline-block"><a href="https://vnu.edu.vn/home" class="text-white">VNU</a></li>
        <li class="d-inline-block px-2 text-white">|</li>
        <li class="d-inline-block"><a href="" class="text-white">Email</a></li>
        <li class="d-inline-block px-2 text-white">|</li>
        <li class="d-inline-block"><a href="" class="text-white">E-office</a></li>
        <li class="d-inline-block px-2 text-white">|</li>
        <li class="d-inline-block"><a href="" class="text-white">Thư viện ảnh</a></li>
    </ul>
    </div>
  </div>
  <div class="container text-right py-2">
    <div class="row d-flex align-items-center">
      <div class="col-md-6 text-left">
        <a href="{{ route('home.index') }}">
          <img style="width: 100%; max-width: 400px; max-height: 150px" alt="" src="{{ Session::get('locale') == 'en' ? asset('images/VNU-SIS-logo(eng).png') : asset('images/VNU-SIS-logo(vns).png') }}" />
        </a>
      </div>
      <div class="col-md-6 text-right">
        <div class="mb-3">
        <div id="google_translate_element" style="display:none"></div>

       <a href="javascript:void(0)" onclick="changeLanguageByButtonClick('vi');return false;" title="Vietnamese" class="glink nturl notranslate">
            <img alt="" onclick="changeLanguageByButtonClick('vi');return false;" width="30" height="20" src="{{ asset('images/vi.jpg') }}" />
          </a>
        <a href="javascript:void(0)" onclick="changeLanguageByButtonClick('en');return false;" title="English" class="glink nturl notranslate">
            <img alt=""  onclick="changeLanguageByButtonClick('en');return false;" width="30" height="20" src="{{ asset('images/en.jpg') }}" />
          </a>
         
          <a href="javascript:void(0)" onclick="changeLanguageByButtonClick('zh-CN');return false;" title="Chinese" class="glink nturl notranslate">
            <img  onclick="changeLanguageByButtonClick('zh-CN');return false;" alt="" width="30" height="20" src="{{ asset('images/china.png') }}" />
          </a>
        </div>
        <div class="mb-3">
          <ul style="font-size: 12px">
            <li class="d-inline-block"><a href="" class="text-dark">Search</a></li>
            <li class="d-inline-block px-2">|</li>
            <li class="d-inline-block"><a href="" class="text-dark">A - Z</a></li>
          </ul>
        </div>
        <div class="input-group ml-auto" style="border-radius: 0.25rem; max-width: 300px">
          <form action="{{ route('posts.handleSearch') }}" method="POST" class="d-flex w-100">
            @csrf
            <input type="text" class="form-control" name="keyword" value="{{ $keyword ?? '' }}"placeholder="Từ khóa" style="font-size: 15px">
            <button class="btn btn-outline-primary text-white bg-vnu-blue" type="submit" style="border:1px solid #0d2c6c"><i class="bi bi-search"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-vnu-blue">
    <nav class="navbar navbar-expand-xl navbar-light py-0" style="font-size: 13px">
      <div class="py-1 ml-auto">
        <button class="navbar-toggler bg-white ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center justify-content-center w-100">
          @foreach ($categoriesHeader as $category)
            @if ($category['id'] == 2)
              <li class="nav-item dropdown">
                <strong class="dropdown-toggle text-white">
                  <a href="https://sisvnu.edu.vn/" class="d-block px-4 py-3 text-white">
                    {{  Session::get('website_language') == 'en' && isset($category['name_en']) ? $category['name_en'] : $category['name'] }}
                  </a>
                </strong>
              </li>
            @elseif (count($category['child']) > 0)
              <li class="nav-item dropdown">
                <strong class="dropdown-toggle text-white">
                  <a href="{{ route('categories.show', $category["slug"]) }}" class="d-block px-4 py-3 text-white">
                    
                    {{ $category['name'] }}
                  </a>
                </strong>
                <ul class="dropdown-menu" style="margin-top: -1px">
                  @include('client.layouts.navbar', ['categories' => $category['child'], 'parentId' => $category["slug"]])
                </ul>
              </li>
            @else
              <li class="nav-item">
                <strong class="dropdown-toggle text-white">
                  <a href="{{ route('categories.show', $category["slug"]) }}" class="d-block px-4 py-3 text-white">
                  {{ $category['name'] }}
                  </a>
                </strong>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
    </nav>
  </div>
</div>
<style type="text/css">
  .skiptranslate iframe{
    display:none !important;
  }
  body{
    top:unset !important
  }
  .header ul li a:hover {
    text-decoration: none;
  }
  .header .dropdown-toggle:after {
    content: none;
  }
  .header .dropdown-menu {
    width: 250px;
    font-size: 13px;
    padding: 0;
  }
  .header .nav-item:hover {
    background-color: #46a5e5;
  }
  .header .dropdown-menu li {
    background-color: #46a5e5;
  }

  .header .dropdown-menu li a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .header .dropdown-menu li:hover {
    color: var(--text-white);
    background-color: #176ac4;
  }
  .header .dropdown-menu li:hover > a {
    color: white !important;
  }
  .header .dropdown-submenu {
    position: relative;
    background-color: #46a5e5;
  }
  .header .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
  }
</style>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
}
function changeLanguageByButtonClick(lang) {
  var language = lang;
  var selectField = document.querySelector("#google_translate_element select");
  for(var i=0; i < selectField.children.length; i++){
    var option = selectField.children[i];
    // find desired langauge and change the former language of the hidden selection-field 
    if(option.value==language){
       selectField.selectedIndex = i;
       // trigger change event afterwards to make google-lib translate this side
       selectField.dispatchEvent(new Event('change'));
       break;
    }
  }
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
<script type="text/javascript">
    
    var url = "https://sis.vnu.edu.vn/lang/change";
    
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
    $("#enLanguage").click(function(){
		 window.location.href = url + "?lang=en";
	});
	$("#viLanguage").click(function(){
		 window.location.href = url + "?lang=vi";
	});
</script>
<script>
function GTranslateGetCurrentLang() {var keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)');return keyValue ? keyValue[2].split('/')[2] : null;}
function GTranslateFireEvent(element,event){try{if(document.createEventObject){var evt=document.createEventObject();element.fireEvent('on'+event,evt)}else{var evt=document.createEvent('HTMLEvents');evt.initEvent(event,true,true);element.dispatchEvent(evt)}}catch(e){}}
function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0])return;if(typeof ga=='function'){ga('send', 'event', 'GTranslate', lang, location.hostname+location.pathname+location.search);}var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(sel[i].className.indexOf('goog-te-combo')!=-1){teCombo=sel[i];break;}if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}
</script>
