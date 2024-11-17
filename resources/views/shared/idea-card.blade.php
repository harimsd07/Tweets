 <div class="card">
                            <div class="px-3 pt-4 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                            src="{{ $idea->user->getImageURL() }}" alt="Mario Avatar">
                                        <div>
                                            <h5 class="card-title mb-0"><a href="{{ route('users.show',$idea->user->id) }}"> {{ $idea->user->name}}
                                                </a></h5>
                                        </div>
                                    </div>
                                <form action="{{ route('ideas.destroy',$idea->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div >
                                        <a href="{{ route('ideas.edit',$idea->id) }}" class="mx-2" >Edit</a>
                                        <a href="{{ route('ideas.show',$idea->id) }}" class ="mx-2" >View</a>
                                        <button class=" ms-2  btn btn-danger btn-sm">X</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($editing ?? false)
                                <div class="row">
                                    <form action="{{ route('ideas.update',$idea->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                                        @error('content')
                                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-dark btn-sm"> Update </button>
                                    </div>
                                    </form>
                                </div>
                                @else
                                <p class="fs-6 fw-light text-muted">
                                    {{ $idea->content}}
                                 </p>
                                @endif

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                                            </span> {{ $idea->likes }} </a>
                                    </div>
                                    <div>
                                        <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                                            {{ $idea->created_at }} </span>
                                    </div>
                                </div>
                                @include('shared.comments')
                            </div>
                        </div>
