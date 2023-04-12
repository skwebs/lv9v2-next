<?php
//$r = (array) $result;echo json_encode($r);exit;

function numToText($num)
{
    $ones = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        '014' => 'fourteen',
    ];
    $tens = [
        0 => 'zero',
        1 => 'ten',
        2 => 'twenty',
        3 => 'thirty',
        4 => 'forty',
        5 => 'fifty',
        6 => 'sixty',
        7 => 'seventy',
        8 => 'eighty',
        9 => 'ninety',
    ];
    $hundreds = ['hundred', 'thousand', 'million', 'billion', 'trillion', 'quardrillion']; /*limit t quadrillion */
    if ($num == 0) {
        return $ones[0];
    } else {
        $num = number_format($num, 2, '.', ',');
        $num_arr = explode('.', $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(',', $wholenum));
        krsort($whole_arr, 1);
        $rettxt = '';
        foreach ($whole_arr as $key => $i) {
            while (substr($i, 0, 1) == '0') {
                $i = substr($i, 1, 5);
            }
            if ($i < 20) {
                /* echo "getting:".$i; */
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                if (substr($i, 0, 1) != '0') {
                    $rettxt .= $tens[substr($i, 0, 1)];
                }
                if (substr($i, 1, 1) != '0') {
                    $rettxt .= ' ' . $ones[substr($i, 1, 1)];
                }
            } else {
                if (substr($i, 0, 1) != '0') {
                    $rettxt .= $ones[substr($i, 0, 1)] . ' ' . $hundreds[0];
                }
                if (substr($i, 1, 1) != '0') {
                    $rettxt .= ' ' . $tens[substr($i, 1, 1)];
                }
                if (substr($i, 2, 1) != '0') {
                    $rettxt .= ' ' . $ones[substr($i, 2, 1)];
                }
            }
            if ($key > 0) {
                $rettxt .= ' ' . $hundreds[$key] . ' ';
            }
        }
        if ($decnum > 0) {
            $rettxt .= ' and ';
            if ($decnum < 20) {
                $rettxt .= $ones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= ' ' . $ones[substr($decnum, 1, 1)];
            }
        }
        return $rettxt;
    }
}
?>



<?php

function res($m)
{
    if ($m > 90) {
        return [
            'g' => 'A+',
            'r' => 'Result is excellent. Keep it up.',
            'c' => 'success text-light',
        ];
    } elseif ($m > 80) {
        return [
            'g' => 'A',
            'r' => 'Result is best but need keep it up.',
            'c' => 'success text-light',
        ];
    } elseif ($m > 70) {
        return [
            'g' => 'B+',
            'r' => 'Result is better Need improve & keep it up.',
            'c' => 'success text-light',
        ];
    } elseif ($m > 60) {
        return [
            'g' => 'B',
            'r' => 'Result is good but not fair. Increase hard work.',
            'c' => 'warning',
        ];
    } elseif ($m > 50) {
        return [
            'g' => 'C+',
            'r' => 'Result is average! Increase hard work.',
            'c' => 'warning',
        ];
    } elseif ($m > 40) {
        return [
            'g' => 'C',
            'r' => 'Result is below to average. Do hard work to improve it.',
            'c' => 'warning',
        ];
    } elseif ($m > 30) {
        return [
            'g' => 'D',
            'r' => 'Result is poor. Need much hard work to improve it.',
            'c' => 'danger text-light',
        ];
    } else {
        return [
            'g' => 'E',
            'r' => 'Result is very poor. Need very much hard work to improve it.',
            'c' => 'danger text-light',
        ];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=750, initial-scale=1.0" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>AMA Student Marksheet</title>
    <style type="text/css">
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                /*Chrome, Safari */
                color-adjust: exact !important;
                /*Firefox*/
                margin: 0;
            }

            #print {
                display: none;
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main-table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 735px;
            background: linear-gradient(rgba(250, 250, 250, 0.85),
                    rgba(255, 255, 255, 0.85)),
                url("{{ asset('images/static/ama300.webp') }}") center/60px 60px round;
        }

        .table,
        .table>td,
        .table>th {
            margin: 0 !important;
        }

        a {
            text-decoration: none;
        }

        .p-seal {
            position: relative;
            bottom: -10px;
            width: 190px;
        }

        .p-sign {
            position: absolute;
            bottom: 60px;
            right: 55px;
            width: 90px;
        }

        .cls-teacher-mukesh {
            position: absolute;
            width: 125px;
            right: 400px;
            bottom: 35px;
        }

        .cls-teacher-pooja {
            position: absolute;
            width: 150px;
            right: 370px;
            bottom: 35px;
        }

        .cls-teacher-sanjana {
            position: absolute;
            width: 120px;
            right: 400px;
            bottom: 35px;
        }

        .exam-ctrl {
            position: absolute;
            width: 70px;
            right: 246px;
            bottom: 35px;
        }
    </style>

<body>
    @foreach ($results as $r)
        <?php
        $qr = '';
        $qr = <<<QRDATA
        "Name: {$r->admitCard->name},
        Father's Name: {$r->admitCard->father},
        Mother: {$r->admitCard->mother},
        Session: {$r->session},
        Class: {$r->admitCard->class}, Roll: {$r->admitCard->roll},
        Obtained Marks: {$r->total}/{$r->full_marks},
        Position in class: {$r->position}
        marks:"
        QRDATA;
        $marks = (array) $r->marks;
        $qr .= json_encode($marks);
        ?>
        <div class="page">


            <table style="margin-bottom:-6px" class="main-table mx-auto">
                <tr>
                    <!-- header -->
                    <td style="height:110px;border: 1px solid black;" class="">
                        <!-- school registration details -->
                        <div class="d-flex justify-content-between">
                            <span class="ps-2">
                                <strong>Estd. : 2017</strong>
                            </span>
                            <span>
                                <strong>AN ISO 9001:2015 CERTIFIED SCHOOL</strong>
                            </span>
                            <span class="pe-2">
                                <strong>Reg. No. 054631</strong>
                            </span>
                        </div>
                        <!-- school header -->
                        <table class="mx-auto px-2" style="width: 100%;">
                            <tr>
                                <td style="width:75px;padding-left:10px">
                                    <img class="float-end" width="75px" height="75px"
                                        src="{{ asset('images/static/ama300.webp') }}" alt="Logo" srcset="" />
                                    {{-- <img class="float-end" width="75px" height="66px"
                                src="{{ asset('images/static/ama-150x133-96.png') }}" alt="Logo" srcset="" /> --}}
                                </td>
                                <td style="width: 100%">
                                    <table style="width: 100%">
                                        <tr>
                                            <td>
                                                <h1 class="text-center mb-0">Anshu Memorial Academy</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="h6 text-center mb-0">
                                                    <a class="text-dark"
                                                        href="https://maps.app.goo.gl/25zkJr8u8qVxau1G9"
                                                        target="_blank">Bhatha Chowk, Bhatha Dasi, Rajapakar,
                                                        Vaishali</a>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="font-size:0.8rem" class="mb-0 text-center mb-0">Run & Managed
                                                    by
                                                    AnitaBindeshwar Foundation (Regd. under Company Act 2013)</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width:75px; padding-right:10px">
                                    <img class="float-start" width="75px" height="75px"
                                        src="{{ asset('images/static/bbbp300.webp') }}" alt="Beti Bachao Beti Padhao"
                                        srcset="" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <!-- student details -->
                    <td class="px-2 mb-0" style="height:260px;border: 1px solid black;">
                        <table class="mx-auto mt-2" style="width: 100%;">
                            <tr>
                                <td>
                                    <h6 class="text-center mb-1"> REPORT CARD [ANNUAL EXAMINATION] </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="text-center">ACADEMIC SESSION : 2022-23</h6>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-sm table-borderless table-borderless ">
                            <tr>
                                <th>Name</th>
                                <td>:</td>
                                <td>{{ $r->admitCard->name }}</td>
                                <td width="" rowspan="4"></td>
                                <th>Class</th>
                                <td>:</td>
                                <td>{{ $r->admitCard->class }}</td>
                                <td style="p-0" rowspan="5" width="150">
                                    {{-- src="{{ asset('uploads/images/students/' . $r->admitCard->image) }}" --}}
                                    <img class="border border-dark" width="100%"
                                        src="{{ $r->admitCard->image ? asset('uploads/images/students/' . $r->admitCard->image) : asset('images/static/paste-image.webp') }}"
                                        alt="Student Image">
                                </td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td>:</td>
                                <td>{{ $r->admitCard->father }}</td>
                                <th>Roll No.</th>
                                <td>:</td>
                                <td>{{ $r->admitCard->roll }}</td>
                            </tr>
                            <tr>
                                <th>Mother's Name</th>
                                <td>:</td>
                                <td>{{ $r->admitCard->mother }}</td>
                                <th>Section</th>
                                <td>:</td>
                                <td>A</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($r->admitCard->dob)) }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>:</td>
                                <td colspan="6">{{ $r->admitCard->address }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <!-- marks -->
                    <td class="py-0 align-baseline" style="height:355px;border: 1px solid black;">
                        <table class="table table-sm table-borderless w-100">
                            <tr>
                                <td>
                                    <table class="table table-sm marks text-center  mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Subjects</th>
                                                <th>Full Marks</th>
                                                <th>Written</th>
                                                <th>Oral</th>
                                                <th>Total</th>
                                                <th>Grades</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <th class="text-start">English</th>
                                            <td>100</td>
                                            <td>{{ $r->marks->english }}</td>
                                            <td>NA</td>
                                            <td>{{ $r->marks->english }}</td>
                                            <td>{{ res($r->marks->english)['g'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Hindi</th>
                                            <td>100</td>
                                            <td>{{ $r->marks->hindi }}</td>
                                            <td>NA</td>
                                            <td>{{ $r->marks->hindi }}</td>
                                            <td>{{ res($r->marks->hindi)['g'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-start">Maths</th>
                                            <td>100</td>
                                            <td>{{ $r->marks->maths }}</td>
                                            <td>NA</td>
                                            <td>{{ $r->marks->maths }}</td>
                                            <td>{{ res($r->marks->maths)['g'] }}</td>
                                        </tr>
                                        @if (!in_array($r->admitCard->class, $classes))
                                            <tr>
                                                <th class="text-start">Science</th>
                                                <td>100</td>
                                                <td>{{ $r->marks->science }}</td>
                                                <td>{{ $r->marks->science_oral }}</td>
                                                <td>{{ $r->marks->science + $r->marks->science_oral }}</td>
                                                <td>{{ res($r->marks->science + $r->marks->science_oral)['g'] }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-start">S.St</th>
                                                <td>100</td>
                                                <td>{{ $r->marks->sst }}</td>
                                                <td>{{ $r->marks->sst_oral }}</td>
                                                <td>{{ $r->marks->sst + $r->marks->sst_oral }}</td>
                                                <td>B+</td>
                                            </tr>
                                            <tr>
                                                <th class="text-start">Computer</th>
                                                <td>100</td>
                                                <td>{{ $r->marks->computer }}</td>
                                                <td>NA</td>
                                                <td>{{ $r->marks->computer }}</td>
                                                <td>{{ res($r->marks->computer)['g'] }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-start">GK</th>
                                                <td>100</td>
                                                <td>{{ $r->marks->gk }}</td>
                                                <td>NA</td>
                                                <td>{{ $r->marks->gk }}</td>
                                                <td>{{ res($r->marks->gk)['g'] }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th class="text-start">Total</th>
                                            <th>{{ $r->full_marks }}</th>
                                            <th>
                                                <?php
                                                if (!in_array($r->admitCard->class, $classes)) {
                                                    echo $r->total - ($r->marks->science_oral + $r->marks->sst_oral);
                                                } else {
                                                    echo $r->total;
                                                } ?>
                                            </th>
                                            <th>
                                                <?php
                                                if (!in_array($r->admitCard->class, $classes)) {
                                                    echo $r->marks->science_oral + $r->marks->sst_oral;
                                                } else {
                                                    echo 'NA';
                                                } ?>
                                            </th>

                                            <th>{{ $r->total }}</th>
                                            <td>{{ res(($r->total * 100) / $r->full_marks)['g'] }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-start ps-5">
                                                <strong>Obtained Marks in words:</strong> {{ $r->total_text }}.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start" colspan="6"><strong>Extra Activity
                                                    (Drawing)
                                                </strong>
                                                Marks: <strong>{{ $r->marks->drawing }}</strong> &nbsp;| Grade:
                                                <strong>{{ res($r->marks->drawing)['g'] }}</strong>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                                <td width="200" class="p-3">
                                    <table width="100%">
                                        <tr>
                                            <td class="border" colspan="3">
                                                {!! QrCode::size(180, 180)->margin(2)->generate($qr) !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <span style="font-size:10px;">Scan QR Code to Check Details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" class="d-flex justify-content-center">
                                                <table class="text-center p-2" width="160">
                                                    <tr class="bg-success text-center fw-bold bg-success text-white">
                                                        <td class="text-center">Grade</td>
                                                        <td>:</td>
                                                        <td class="pe-2 py-2">
                                                            {{ res(($r->total * 100) / $r->full_marks)['g'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="pb-0 text-center">
                                    <span style="font-size: 11px;"
                                        class="bg-light border-bottom d-inline-block border-secondary">
                                        <strong>Grading Scale :</strong> A+(91%-100%), A(81%-90%), B+(71%-80%),
                                        B(61%-70%),
                                        C+(51%-60%), C(41%-50%), D(31%-40%), E(30% & Below) </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">
                        <table class="table table-sm table-bordered border border-dark text-center">
                            <tr>
                                <th>Obtained Marks</th>
                                <th>Obtained Marks %</th>
                                <th>Grade</th>
                                <th>Position in Class</th>
                            </tr>
                            <tr>
                                <td>{{ $r->total }}/{{ $r->full_marks }}</td>
                                <td>
                                    <?php
                                    echo round(($r->total * 100) / $r->full_marks, 2);
                                    ?>%
                                </td>
                                <td>{{ res(($r->total * 100) / $r->full_marks)['g'] }}</td>
                                <td>{{ $r->position }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <!-- office section -->
                    <td class="align-bottom" style="height:145px;position:relative;">
                        <table class="table table-sm table-borderless text-center">
                            <tr>
                                <td width="25%" class="align-bottom">{{ date('d-m-Y') }}</td>
                                {{-- <td width="25%"></td> --}}
                                <td width="25%">
                                    @if ($r->admitCard->class === 'LKG')
                                        <img class="cls-teacher-sanjana"
                                            src="{{ asset('images/static/sanjana-sign.webp') }}">
                                    @endif
                                    @if ($r->admitCard->class === 'UKG')
                                        <img class="cls-teacher-pooja"
                                            src="{{ asset('images/static/pooja-sign.webp') }}">
                                    @endif
                                    @if ($r->admitCard->class === 'Play')
                                        <img class="cls-teacher-mukesh"
                                            src="{{ asset('images/static/mukesh-sign.webp') }}">
                                    @endif
                                    @if (!in_array($r->admitCard->class, ['Play', 'LKG', 'UKG']))
                                        <img class="cls-teacher-mukul"
                                            src="{{ asset('images/static/mukul-sign.webp') }}">
                                    @endif
                                </td>
                                <td width="25%">
                                    <img class="exam-ctrl" src="{{ asset('images/static/mukul-sign.webp') }}">
                                </td>
                                <td width="25%">
                                    <img class="p-sign" src="{{ asset('images/static/principal_sign300.webp') }}">
                                    <img class="p-seal" src="{{ asset('images/static/principal_seal400.webp') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Print Date</td>
                                <td>Class Teacher</td>
                                <td>Exam Controller</td>
                                <td>Principal</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="bg-success text-light" style="height:15px;border: 1px solid black;">
                        <div class="d-flex justify-content-around">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path
                                        d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                                <a class="text-light" href="tel:9931313833">9931313833</a>
                                &nbsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                                <a class="text-light" href="tel:9128289100">9128289100</a>
                            </span> | <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                                <a class="text-light"
                                    href="mailto:contact@anshumemorial.in">contact@anshumemorial.in</a>
                            </span> | <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                    <path
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                                </svg>
                                <a class="text-light" href="https://anshumemorial.in"
                                    target="_blank">www.anshumemorial.in</a>
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
            <small style="font-size:10px;" class="align-baseline w-100 text-center d-inline-block bg-light">Designed
                &amp;
                Developed by <a href="#">Anshu Memorial Academy</a> (IT Team)</small>
        </div>
    @endforeach
</body>

</html>
