@extends('layouts.app')

@section('content')
@include('components.user_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Review</h3>
                    @if ($data->first()->is_reviewed == 1)
                    <h3>Waduh, sepertinya kamu sudah pernah memberikan ulasan untuk pembelian ini</h3>
                    @else
                    <div class="review-submission">
                        <h3 class="tab-title">Berikan rating untuk pembelian ini</h3>
                        <div class="review-submit">
                            <form action="{{ route('user.review.store', $data->first()->midtrans_booking_code) }}"
                                class="row" method="POST">
                                @csrf
                                <div class="ml-2">
                                    <input class="star star-5" value="5" id="star-5" type="radio" name="rating" />
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" value="4" id="star-4" type="radio" name="rating" />
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" value="3" id="star-3" type="radio" name="rating" />
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" value="2" id="star-2" type="radio" name="rating" />
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" value="1" id="star-1" type="radio" name="rating" />
                                    <label class="star star-1" for="star-1"></label>
                                </div>
                                @if ($errors->has('rating'))
                                <p class="col-12 text-danger ml-2">{{ $errors->first('rating') }}</p>
                                @endif
                                <div class="col-12">
                                    <h3 class="tab-title">Berikan juga kesan kamu untuk pembelian ini</h3>
                                    <textarea name="comment" id="comment" rows="10"
                                        class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
                                        placeholder="Minimal 10 karakter, maksimal 100 karakter" maxlength="100"
                                        required></textarea>
                                    <span class="pull-right label label-default" id="count_message"></span>
                                </div>
                                <div class="col mt-2">
                                    <button type="submit" class="btn btn-main">Buat Review</button>
                                </div>
                                <div class="cd-flex flex-row-reverse mt-2 mr-3">
                                    <a class="btn btn-danger" role="button" href="{{ route('user.transaction.complete') }}">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection

@section('js')
<script>
    $('#addStar').change('.star', function (e) {
        $(this).submit();
    });

</script>
<script>
    var text_max = 100;
    $('#count_message').html('0 / ' + text_max);

    $('#comment').keyup(function () {
        var text_length = $('#comment').val().length;
        var text_remaining = text_max - text_length;

        $('#count_message').html(text_length + ' / ' + text_max);
    });

</script>
@endsection
