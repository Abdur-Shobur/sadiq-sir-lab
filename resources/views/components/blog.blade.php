
		<!-- Start Blog Area -->
		<section class="blog-area ptb-120 ">
			<div class="container">
				<div class="section-title text-center">
					<span class="bg-ff5d24">Blog Update</span>
					<h2>Blog Posts</h2>
					<p>
						Stay updated with the latest blog posts from our team.
					</p>
				</div>

				<div class="row justify-content-center">
					@forelse($blogs->take(3) as $blog)
						<div class="col-lg-4 col-md-6">
							<div class="single-blog-post">
								<div class="post-image">
									<a href="{{ route('blog.detail', $blog->id) }}">
										@if($blog->image)
										<img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" />
										@else
											<img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $blog->title }}" />
										@endif
									</a>

									<div class="date">{{ $blog->created_at->format('d M, Y') }}</div>
								</div>

								<div class="post-content">
									<span>By: <a href="{{ route('blog.detail', $blog->id) }}">{{ $blog->author ?? 'Admin' }}</a></span>
									<h3>
										<a href="{{ route('blog.detail', $blog->id) }}">
											{{ $blog->title }}
										</a>
									</h3>
									<p>
										{{ Str::limit($blog->subtitle ?? $blog->content, 120) }}
									</p>
									<a href="{{ route('blog.detail', $blog->id) }}" class="learn-more-btn">
										Learn More <i class="flaticon-arrow-pointing-to-right"></i>
									</a>
								</div>
							</div>
						</div>
					@empty
						<div class="col-12">
							<div class="text-center">
								<p>No blog posts found.</p>
							</div>
						</div>
					@endforelse
				</div>
			</div>
		</section>
		<!-- End Blog Area -->
