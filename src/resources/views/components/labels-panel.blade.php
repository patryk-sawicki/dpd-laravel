<div style="background-color: #fff8ef;">
    <div class="">
        <h2><a data-toggle="collapse" href="#dpdApi" role="button" aria-expanded="false"
               aria-controls="dpdApi"><img
                        src="{!! route('dpd.img', ['dpd_logo', 'png']) !!}" alt="DPD"
                        width="50"> <small>(Kliknij aby wyświetlić)</small></a></h2>
    </div>

    <div class="collapse" id="dpdApi">
        <form action="{{ route('dpd.generateShippingLabel', ['disc' => $disc ?? 'public', 'dir' => $dir ?? 'labels', 'file' => $file ?? 'label']) }}"
              method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                {{--Destination Code--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-destination_code">Punkt Odbioru</label>
                    <input type="text" name="dpd[services][dpdPickup][pudo]"
                           id="dpd-destination_code" placeholder="Punkt Odbioru"
                           value="{{ $destinationCode ?? '' }}"
                           class="form-control"
                           maxlength="15"
                    >
                </div>

                {{--weight--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-weight">Waga (kg)</label>
                    <input type="number" name="dpd[parcels][weight]"
                           id="dpd-weight" placeholder="Waga (kg)"
                           value="{{ $weight ?? '' }}"
                           class="form-control"
                           step="0.01"
                    >
                </div>

                {{--sizeX--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sizeX">Rozmiar x (cm)</label>
                    <input type="number" name="dpd[parcels][sizeX]"
                           id="dpd-sizeX" placeholder="Rozmiar x (cm)"
                           value="{{ $sizeX ?? '' }}"
                           class="form-control"
                           step="1"
                    >
                </div>

                {{--sizeY--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sizeY">Rozmiar y (cm)</label>
                    <input type="number" name="dpd[parcels][sizeY]"
                           id="dpd-sizeY" placeholder="Rozmiar y (cm)"
                           value="{{ $sizeY ?? '' }}"
                           class="form-control"
                           step="1"
                    >
                </div>

                {{--sizeZ--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sizeZ">Rozmiar z (cm)</label>
                    <input type="number" name="dpd[parcels][sizeZ]"
                           id="dpd-sizeZ" placeholder="Rozmiar z (cm)"
                           value="{{ $sizeZ ?? '' }}"
                           class="form-control"
                           step="1"
                    >
                </div>
            </div>

            <h2>Odbiorca</h2>

            <div class="row">
                {{--Name--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-name">Nazwa</label>
                    <input type="text" name="dpd[receiver][name]" id="dpd-name" placeholder="Nazwa"
                           value="{{ $receiverName ?? '' }}"
                           class="form-control js-required" required
                           maxlength="30">
                </div>

                {{--Phone Number--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-receiver_phone">Telefon</label>
                    <input type="tel" name="dpd[receiver][phone]" id="dpd-receiver_phone"
                           placeholder="Telefon"
                           value="{{ $receiverPhone ?? '' }}" class="form-control js-required" required
                           maxlength="9">
                </div>

                {{--E-mail--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-receiver_email">E-mail</label>
                    <input type="email" name="dpd[receiver][email]" id="dpd-receiver_email" placeholder="E-mail"
                           value="{{ $receiverEmail ?? '' }}" class="form-control js-required" maxlength="60">
                </div>
            </div>

            <h2>Nadawca</h2>

            <div class="row">
                {{--Sender Name--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sender_name">Nazwa</label>
                    <input type="text" name="dpd[sender][name]" id="dpd-sender_name" placeholder="Nazwa"
                           value="{{ $senderName ?? '' }}" class="form-control js-required" required
                           maxlength="30">
                </div>

                {{--Sender E-mail--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sender_email">E-mail</label>
                    <input type="email" name="dpd[sender][email]" id="dpd-sender_email" placeholder="E-mail"
                           value="{{ $senderEmail ?? '' }}" class="form-control js-required" required
                           maxlength="60">
                </div>

                {{--Sender address--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sender_address">Adres</label>
                    <input type="text" name="dpd[sender][address]" id="dpd-sender_address" placeholder="Adres"
                           value="{{ $senderAddress ?? '' }}"
                           class="form-control js-required" required maxlength="30">
                </div>

                {{--Sender City--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sender_city">Miasto</label>
                    <input type="text" name="dpd[sender][city]" id="dpd-sender_city"
                           placeholder="Miasto"
                           value="{{ $senderCity ?? '' }}"
                           class="form-control js-required" required maxlength="30">
                </div>

                {{--Sender Post Code--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sender_post_code">Kod pocztowy</label>
                    <input type="text" name="dpd[sender][postalCode]" id="dpd-sender_post_code"
                           placeholder="Kod pocztowy"
                           value="{{ $senderPostCode ?? '' }}"
                           class="form-control js-required" required maxlength="6">
                </div>

                {{--Sender Phone--}}
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 mb-10-px">
                    <label for="dpd-sender_receiver_phone">Telefon</label>
                    <input type="tel" name="dpd[sender][phone]" id="dpd-sender_phone"
                           placeholder="Telefon"
                           value="{{ $senderPhone ?? '' }}" class="form-control js-required" required
                           maxlength="9">
                </div>
            </div>

            <button type="submit" id="dpd-create" class="btn btn-warning">Utwórz</button>
        </form>
    </div>
</div>