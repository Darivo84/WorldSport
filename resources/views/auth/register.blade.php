@extends('layouts.app')
{{-- PAGE: REGISTER-1 --}}
@section('content')

    {{-- SECTION REGISTER --}}
    <section class="section-register">
        <div class="container">
            <div class="row">

                {{-- PAGE HEADER --}}
                <div class="col-md-12">
                    <header>
                        <h1>REGISTER</h1>

                        <p>
                            SHOULD YOU PREFER A SALES AGENT TO COME TO YOUR OFFICE AND ASSIST WITH THE REGISTRATION,
                            PLEASE CALL US ON 0861 90 90 90 TO SET UP AN APPOINTMENT, OTHERWISE PLEASE COMPLETE THE FORM
                            BELOW.
                        </p>
                    </header>
                </div>
            </div>

            <div class="errors">
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="register-forms">

                        {{-- FORM SECTION HEADER --}}
                        <h2 class="text-left bg-green">COMPANY DETAILS</h2>

                        {{-- REGISTER FORM START--}}
                        <form action="{{ url('register-company-details-store') }}" class="form" method="post">

                            {{csrf_field()}}

                            {{-- FORM INPUTS --}}
                            <div class="form-group">
                                <label for="company_name">Registered Company Name/Sole Proprietor Name <i class="fa fa-asterisk" aria-hidden="true"></i></label>

                                <input type="text" name="company_name" id="company_name" class="full-input"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="trading_name">Trading -as Name <i class="fa fa-asterisk" aria-hidden="true"></i></label>

                                <input type="text" name="trading_name" id="trading_name" class="full-input"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="registration_number">Company Registration Number/Sole Proprietor ID <i class="fa fa-asterisk" aria-hidden="true"></i></label>

                                <input type="text" name="registration_number" id="registration_number"
                                       class="full-input"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="vat_number">VAT Number <i class="fa fa-asterisk" aria-hidden="true"></i></label>

                                <input type="text" name="vat_number" id="vat_number" class="full-input"
                                       required>
                            </div>

                            {{-- INDUSTRY CATEGORTIES --}}
                            <label for="">Select Industry Categories:</label>

                            <div class="form-checkbox-group form-group">
                                @foreach($industryCategories as $category)
                                    <div class="clearfix {{ strtoupper($category->name) == $category->name ? "grey-underline" : ""}}">
                                        <input type="checkbox" class="pull-right ind-cat category_id "
                                               name="industry_category_id[]"
                                               id="{{ $category->name }}" value="{{ $category->id }}">

                                        <label for="industry_category_id"
                                               class="text-black">{{ strtoupper($category->name) == $category->name ? $category->name : " -" . $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            {{--Add selected button --}}
                            <div class="form-group clearfix">
                                <a href="" class="add_selected_category btn btn-purple pull-right">Add Selected</a>
                            </div>

                            {{-- new selected inputs --}}
                            <div class="selectedCategoryBox form-checkbox-group form-group"></div>

                            {{-- Remove selected button --}}
                            <div class="form-group clearfix">
                                <a href="#" class="remove_selected_category btn btn-purple pull-right">Remove
                                                                                                       Selected</a>
                            </div>

                            {{-- SELECT REGIONS --}}
                            <label for="">Select Regions:</label>
                            <div class="form-group clearfix form-checkbox-group">

                                @foreach($regions as $region)
                                    <div class="clearfix {{ strtoupper($region->name) == $region->name ? "grey-underline" : ""}}">
                                        {{--<label for="region_id">{{ strtoupper($region->name) == $region->name ? $region->name : ' -' . $region->name }}</label>--}}
                                        <label for="region">{{ $region->name }}</label>
                                        <input type="checkbox" class="pull-right region_id" name="region_id[]"
                                               id="{{ $region->name }}"
                                               value="{{ $region->id }}">
                                        <br>
                                    </div>

                                @endforeach
                            </div>

                            {{--Add selected button --}}
                            <div class="form-group clearfix">
                                <a href="" class="add_selected_region btn btn-purple pull-right">Add Selected</a>
                            </div>

                            {{-- new selected inputs --}}
                            <div class="selectedRegionBox form-checkbox-group form-group"></div>

                            {{-- Remove selected button --}}
                            <div class="form-group clearfix">
                                <a href="#" class="remove_selected_region btn btn-purple pull-right">Remove Selected</a>
                            </div>

                            {{-- SELECT BUSINESS SIZE --}}
                            <div class="form-group">
                                <label for="business_size_id">Business Size <i class="fa fa-asterisk" aria-hidden="true"></i></label>

                                <select name="business_size_id" id="business_size_id" class="full-input">
                                    <option value="0">-- Not Selected --</option>
                                    @foreach($businessSizes as $businessSize)
                                        <option value="{{$businessSize->id}}">{{ $businessSize->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- SELECT BUSINESS CATEGORY --}}
                            <div class="form-group">
                                <label for="business_category_id">Business Category <i class="fa fa-asterisk" aria-hidden="true"></i></label>

                                <select name="business_category_id" id="business_category_id" class="full-input">
                                    <option value="#">-- Not Selected --</option>
                                    @foreach($businessCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- PLEASE NOTE --}}
                            <div class="panel panel-default login-please-note">
                                <h3>Please Note:</h3>

                                <ul>
                                    <li>Your account will be activated upon receipt of:</li>

                                    <li>
                                        1. The Activation fee of R255.00
                                        (Incl. VAT)
                                    </li>
                                    <li>2. Verification of your details by Accountability doing either a
                                        Business or Consumer Search on your company*, will be available for you to view
                                        on
                                        Saved Reports. The cost of this report will be charged to your account.
                                    </li>
                                    <li>3.Completion
                                        of the Accountability Signatory and Instructions page.
                                    </li>
                                    <li>4.Upon activation, your User
                                        Name and Password will be sent to your nominated e-mail address
                                    </li>
                                </ul>

                                <p>The Accountability membership contract is for a 12 month period at R255.00 (Incl.
                                   VAT) per month excluding monthly instruction activity on our site. Should you wish
                                   to cancel, you should do so a month prior to your anniversary date. Failure to do so
                                   will result in a renewal of your contract for a further 12 months.</p>

                                <p>
                                    Further invoices for the monthly premium and services rendered will be collected by
                                    debit order, no earlier than the 25th of the month and by no later than the last
                                    working day of that month. This will also apply to collections during December. *
                                    Should you be joining as a sole proprietor, a consumer credit report will be done.
                                </p>

                                <p>
                                    To read our Terms & Conditions <a href="">click here</a><br>
                                    To read our Disclaimer <a href="">click here</a>
                                </p>

                            </div>

                            {{-- NEXT/SUBMIT --}}
                            <div class="form-group clearfix">
                                <input type="submit" value="NEXT" class="btn btn-purple text-black pull-right">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="register-page-no">
                    <ul>
                        <li class="active-page">1</li>
                        <li>2</li>
                        <li>3</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
