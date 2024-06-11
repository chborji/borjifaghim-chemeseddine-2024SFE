@extends('layouts.admin.app')

@section('title','Paramètres')

@push('css_or_js')
<style>
    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 23px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #377dff;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #377dff;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    #banner-image-modal .modal-content {
        width: 1116px !important;
        margin-left: -264px !important;
    }

    @media (max-width: 768px) {
        #banner-image-modal .modal-content {
            width: 698px !important;
            margin-left: -75px !important;
        }


    }

    @media (max-width: 375px) {
        #banner-image-modal .modal-content {
            width: 367px !important;
            margin-left: 0 !important;
        }

    }

    @media (max-width: 500px) {
        #banner-image-modal .modal-content {
            width: 400px !important;
            margin-left: 0 !important;
        }


    }
</style>
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title">{{\App\CentralLogics\translate('configuration')}} {{\App\CentralLogics\translate('restaurant')}}</h1>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <!--   <div class="col-md-8 mb-3 mt-3">
            <div class="card">
                <div class="card-body" style="padding-bottom: 12px">
                    <div class="row">
                        @php($config=\App\CentralLogics\Helpers::get_business_settings('maintenance_mode'))
                        <div class="col-6">
                            <h5>
                                <i class="tio-settings-outlined"></i>
                                {{\App\CentralLogics\translate('maintenance_mode')}}
                            </h5>
                        </div>
                        <div class="col-6">
                            <label class="switch ml-3 float-right">
                                <input type="checkbox" class="status" onclick="maintenance_mode()" {{isset($config) && $config?'checked':''}}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4  mb-3 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center"><i class="tio-money"></i> Currency Symbol Position</h5>
                    <i class="tio-dollar"></i>
                </div>
                <div class="card-body">
                    @php($config=\App\CentralLogics\Helpers::get_business_settings('currency_symbol_position'))
                    <div class="form-row">
                        <div class="col-sm mb-2 mb-sm-0">
                            
                            <div class="form-control">
                                <div class="custom-control custom-radio custom-radio-reverse"onclick="currency_symbol_position('{{route('admin.business-settings.currency-position',['left'])}}')">
                                    <input type="radio" class="custom-control-input" name="projectViewNewProjectTypeRadio" id="projectViewNewProjectTypeRadio1" {{(isset($config) && $config=='left')?'checked':''}}>
                                    <label class="custom-control-label media align-items-center" for="projectViewNewProjectTypeRadio1">
                                        <i class="tio-agenda-view-outlined text-muted mr-2"></i>
                                        <span class="media-body">
                                            {{\App\CentralLogics\Helpers::currency_symbol()}} Left
                                        </span>
                                    </label>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-sm mb-2 mb-sm-0">
                          
                            <div class="form-control">
                                <div class="custom-control custom-radio custom-radio-reverse"onclick="currency_symbol_position('{{route('admin.business-settings.currency-position',['right'])}}')">
                                    <input type="radio" class="custom-control-input" name="projectViewNewProjectTypeRadio" id="projectViewNewProjectTypeRadio2" {{(isset($config) && $config=='right')?'checked':''}}>
                                    <label class="custom-control-label media align-items-center" for="projectViewNewProjectTypeRadio2">
                                        <i class="tio-table text-muted mr-2"></i>
                                        <span class="media-body">
                                            Right {{\App\CentralLogics\Helpers::currency_symbol()}}
                                        </span>
                                    </label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <center>
                <h4><i class="tio-settings"></i> Paramètres généraux</h4>
                <hr>
            </center>
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.business-settings.update-setup')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @php($name=\App\Model\BusinessSetting::where('key','restaurant_name')->first()->value)
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('Intitulé')}} {{\App\CentralLogics\translate('restaurant')}}</label>
                        <input type="text" name="restaurant_name" value="{{$name}}" class="form-control" placeholder="Restaurant" required>
                    </div>

                    <div class="row">
                        @php($open=\App\Model\BusinessSetting::where('key','restaurant_open_time')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('ouverture')}}</label>
                                <input type="time" value="{{$open}}" name="restaurant_open_time" class="form-control" placeholder="Ex : 10:30 am" required>
                            </div>
                        </div>
                        @php($close=\App\Model\BusinessSetting::where('key','restaurant_close_time')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('fermeture')}}</label>
                                <input type="time" value="{{$close}}" name="restaurant_close_time" class="form-control" placeholder="00:00 pm" required>
                            </div>
                        </div>
                        @php($currency_code=\App\Model\BusinessSetting::where('key','currency')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('devise')}}</label>
                                <select name="currency" class="form-control js-select2-custom">
                                    @foreach(\App\Model\Currency::orderBy('currency_code')->get() as $currency)
                                    <option value="{{$currency['currency_code']}}" {{$currency_code==$currency['currency_code']?'selected':''}}>
                                        {{$currency['currency_code']}} ( {{$currency['currency_symbol']}} )
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="country">{{\App\CentralLogics\translate('pays')}}</label>
                                <select id="country" name="country" class="form-control  js-select2-custom">
                                    <option value="TN">Tunisia</option>
                                    <option value="AX">Åland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia, Plurinational State of</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard Island and McDonald Islands</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RE">Réunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthélemy</option>
                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin (French part)</option>
                                    <option value="PM">Saint Pierre and Miquelon</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UM">United States Minor Outlying Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="VG">Virgin Islands, British</option>
                                    <option value="VI">Virgin Islands, U.S.</option>
                                    <option value="WF">Wallis and Futuna</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
            {{--             <div class="col-md-4 col-12">

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{\App\CentralLogics\translate('translation')}}</label>
                                <select name="language[]" id="language" data-maximum-selection-length="3" class="form-control js-select2-custom" multiple=true>
                                    <option value="en">English(default)</option>
                                    <option value="fr-FR">French (France) - français (France)</option>
                                    <option value="ar">Arabic - العربية</option>

                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('fuseau horaire')}}</label>
                                <select name="time_zone" id="time_zone" data-maximum-selection-length="3" class="form-control js-select2-custom">

                                    <option value='Africa/Tunisia'>(UTC +1) Tunisia</option>

                                    <option value='America/Los_Angeles'>(UTC-08:00) Pacific Time (US &amp; Canada)
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @php($phone=\App\Model\BusinessSetting::where('key','phone')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('tel')}}</label>
                                <input type="text" value="{{$phone}}" name="phone" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        @php($email=\App\Model\BusinessSetting::where('key','email_address')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('email')}}</label>
                                <input type="email" value="{{$email}}" name="email" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        @php($address=\App\Model\BusinessSetting::where('key','address')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('addresse')}}</label>
                                <input type="text" value="{{$address}}" name="address" class="form-control" placeholder="" required>
                            </div>
                        </div>

                        <!-- @php($mov=\App\Model\BusinessSetting::where('key','minimum_order_value')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('min')}} {{\App\CentralLogics\translate('order')}} {{\App\CentralLogics\translate('value')}}
                                    ( {{\App\CentralLogics\Helpers::currency_symbol()}} )</label>
                                <input type="number" min="1" value="{{$mov}}" name="minimum_order_value" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        @php($value=\App\Model\BusinessSetting::where('key','point_per_currency')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> <strong>1
                                        ( {{\App\CentralLogics\Helpers::currency_symbol()}} )
                                        = {{$value}} {{\App\CentralLogics\translate('internal')}} {{\App\CentralLogics\translate('points')}}</strong>
                                </label>
                                <input type="number" min="1" value="{{$value}}" name="point_per_currency" class="form-control" placeholder="" required>
                            </div>
                        </div>
-->
                        @php($pagination_limit=\App\Model\BusinessSetting::where('key','pagination_limit')->first()->value)
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{\App\CentralLogics\translate('pagination')}}</label>
                                <input type="text" value="{{$pagination_limit}}" name="pagination_limit" class="form-control" placeholder="" required>
                            </div>
                        </div>

                        @php($footer_text=\App\Model\BusinessSetting::where('key','footer_text')->first()->value)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('pied de page ')}} {{\App\CentralLogics\translate('texte')}}</label>
                                <input type="text" value="{{$footer_text}}" name="footer_text" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>

                    <!--  <div class="row">
                        <div class="col-md-4 col-12">
                            @php($pv=\App\CentralLogics\Helpers::get_business_settings('phone_verification'))
                            <div class="form-group">
                                <label>{{\App\CentralLogics\translate('phone')}} {{\App\CentralLogics\translate('verification')}} ( OTP
                                    )</label><small style="color: red">*</small>
                                <div class="input-group input-group-md-down-break">
                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="1" name="phone_verification" id="phone_verification_on" {{(isset($pv) && $pv==1)?'checked':''}}>
                                            <label class="custom-control-label" for="phone_verification_on">{{\App\CentralLogics\translate('on')}}</label>
                                        </div>
                                    </div>

                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="0" name="phone_verification" id="phone_verification_off" {{(isset($pv) && $pv==0)?'checked':''}}>
                                            <label class="custom-control-label" for="phone_verification_off">{{\App\CentralLogics\translate('off')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            @php($sp=\App\CentralLogics\Helpers::get_business_settings('self_pickup'))
                            <div class="form-group">
                                <label>{{\App\CentralLogics\translate('self_pickup')}}</label><small style="color: red">*</small>
                                <div class="input-group input-group-md-down-break">
                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="1" name="self_pickup" id="sp1" {{$sp==1?'checked':''}}>
                                            <label class="custom-control-label" for="sp1">{{\App\CentralLogics\translate('on')}}</label>
                                        </div>
                                    </div>

                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="0" name="self_pickup" id="sp2" {{$sp==0?'checked':''}}>
                                            <label class="custom-control-label" for="sp2">{{\App\CentralLogics\translate('off')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            @php($sp=\App\CentralLogics\Helpers::get_business_settings('delivery'))
                            <div class="form-group">
                                <label>{{\App\CentralLogics\translate('delivery')}}</label><small style="color: red">*</small>
                                <div class="input-group input-group-md-down-break">
                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="1" name="delivery" id="dl1" {{$sp==1?'checked':''}}>
                                            <label class="custom-control-label" for="dl1">{{\App\CentralLogics\translate('on')}}</label>
                                        </div>
                                    </div>

                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="0" name="delivery" id="dl2" {{$sp==0?'checked':''}}>
                                            <label class="custom-control-label" for="dl2">{{\App\CentralLogics\translate('off')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            @php($ev=\App\Model\BusinessSetting::where('key','email_verification')->first()->value)
                            <div class="form-group">
                                <label>{{\App\CentralLogics\translate('email')}} {{\App\CentralLogics\translate('verification')}}</label><small style="color: red">*</small>
                                <div class="input-group input-group-md-down-break">
                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="1" name="email_verification" id="email_verification_on" {{$ev==1?'checked':''}}>
                                            <label class="custom-control-label" for="email_verification_on">{{\App\CentralLogics\translate('on')}}</label>
                                        </div>
                                    </div>

                                   
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" value="0" name="email_verification" id="email_verification_off" {{$ev==0?'checked':''}}>
                                            <label class="custom-control-label" for="email_verification_off">{{\App\CentralLogics\translate('off')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php($config=\App\CentralLogics\Helpers::get_business_settings('delivery_management'))
                        <div class="col-md-6 col-12">
                            @php($delivery=\App\Model\BusinessSetting::where('key','delivery_charge')->first()->value)
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('delivery')}} {{\App\CentralLogics\translate('charge')}}</label>
                                <input type="number" min="0" step=".01" id="delivery_charge" name="delivery_charge" value="{{$delivery}}" class="form-control" placeholder="Ex: 100" required {{$config['status']==1?'disabled':''}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body" style="padding: 20px">
                                    <h5 class="text-center">{{\App\CentralLogics\translate('delivery')}} {{\App\CentralLogics\translate('management')}}</h5>
                                    @csrf
                                    <div class="form-group mb-2 mt-2">
                                        <input type="radio" id="shipping_by_distance_status" name="shipping_status" value="1" {{$config['status']==1?'checked':''}}>
                                        <label style="padding-left: 10px">{{\App\CentralLogics\translate('delivery')}} {{\App\CentralLogics\translate('charge')}} {{\App\CentralLogics\translate('by_distance')}}</label>
                                        <br>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="radio" id="default_delivery_status" name="shipping_status" value="0" {{$config['status']==0?'checked':''}}>
                                        <label style="padding-left: 10px">{{\App\CentralLogics\translate('default')}} {{\App\CentralLogics\translate('delivery')}} {{\App\CentralLogics\translate('charge')}}</label>
                                        <br>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label style="padding-left: 10px">{{\App\CentralLogics\translate('minimum')}} {{\App\CentralLogics\translate('shipping')}} {{\App\CentralLogics\translate('charge')}}</label>
                                        <input type="number" min="0" step=".01" id="min_shipping_charge" name="min_shipping_charge" value="{{$config['min_shipping_charge']}}" class="form-control" placeholder="100" {{$config['status']==0?'disabled':''}}>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label style="padding-left: 10px">{{\App\CentralLogics\translate('shipping')}} {{\App\CentralLogics\translate('charge')}} / {{\App\CentralLogics\translate('kilometer')}}</label>
                                        <input type="number" min="0" step=".01" id="shipping_per_km" name="shipping_per_km" value="{{$config['shipping_per_km']}}" class="form-control" placeholder="20" {{$config['status']==0?'disabled':''}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    @php($logo=\App\Model\BusinessSetting::where('key','logo')->first()->value)
                    <div class="form-group mt-3">
                        <label>{{\App\CentralLogics\translate('logo')}}</label><small style="color: red">*
                            ( {{\App\CentralLogics\translate('ratio')}} 3:1 )</small>
                        <div class="custom-file">
                            <input type="file" name="logo" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="customFileEg1">{{\App\CentralLogics\translate('choisir')}} {{\App\CentralLogics\translate('fichier')}}</label>
                        </div>
                        <hr>
                        <center>
                            <img style="height: 100px;border: 1px solid; border-radius: 10px;" id="viewer" src="{{asset('storage/restaurant/'.$logo)}}" alt="logo image" />
                        </center>
                    </div>
                    <hr>
                    <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}" class="btn btn-primary mb-2">{{\App\CentralLogics\translate('Valider')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_2')
<script>
    /* @php($time_zone = \App\Model\BusinessSetting::where('key', 'time_zone')->first());
    @php($time_zone = $time_zone-> value ?? null) $('[name=time_zone]').val("{{$time_zone}}");
    @php($language = \App\Model\BusinessSetting::where('key', 'language')->first());
    @php($language = $language -> value ?? null)
    let language =  ($language); ;
    $('[id=language]').val(language);*/

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileEg1").change(function() {
        readURL(this);
    });
    $("#language").on("change", function() {
        $("#alert_box").css("display", "block");
    });
</script>

<script>
    if (env('APP_MODE') == 'demo')

    function maintenance_mode() {
        toastr.info('Disabled for demo version!')
    } else

    function maintenance_mode() {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Be careful before you turn on/off maintenance mode',
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#377dff',
            cancelButtonText: 'Non',
            confirmButtonText: 'Oui',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.get({
                    url: "{{route('admin.business-settings.maintenance-mode')}}",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    complete: function() {
                        $('#loading').hide();
                    },
                });
            } else {
                location.reload();
            }
        })
    };



    /*function currency_symbol_position(route) {
        $.get({
            url: route,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                toastr.success(data.message);
            },
            complete: function() {
                $('#loading').hide();
            },
        });
    }

    $(document).on('ready', function() {
        @php($country = \App\CentralLogics\Helpers::get_business_settings('country') ?? 'BD')
        $("#country option[value='{{$country}}']").attr('selected', 'selected').change();
    })*/
</script>

<!-- <script>
    $('#shipping_by_distance_status').on('click', function() {
        $("#delivery_charge").prop('disabled', true);
        $("#min_shipping_charge").prop('disabled', false);
        $("#shipping_per_km").prop('disabled', false);
    });

    $('#default_delivery_status').on('click', function() {
        $("#delivery_charge").prop('disabled', false);
        $("#min_shipping_charge").prop('disabled', true);
        $("#shipping_per_km").prop('disabled', true);
    });
</script>

<script>
    $(document).ready(function() {
        $("#phone_verification_on").click(function() {
            if ($('#email_verification_on').prop("checked") == true) {
                $('#email_verification_off').prop("checked", true);
                $('#email_verification_on').prop("checked", false);
                const message = "Both Phone & Email verification can't be active at a time";
                toastr.info(message);
            }
        });
        $("#email_verification_on").click(function() {
            if ($('#phone_verification_on').prop("checked") == true) {
                $('#phone_verification_off').prop("checked", true);
                $('#phone_verification_on').prop("checked", false);
                const message = "Both Phone & Email verification can't be active at a time";
                toastr.info(message);
            }
        });
    });
</script> -->
@endpush