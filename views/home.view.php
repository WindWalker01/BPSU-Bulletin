
  <div class="flex flex-col min-h-screen">

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
      <div class="lg:col-span-8 space-y-8 order-2 lg:order-1">
        <?php
        $posts = [
          [
            'author' => 'Dr. Marcus Evans',
            'avatar' => 'https://lh3.googleusercontent.com/...your-url...',
            'date' => 'October 26, 2023',
            'category' => 'University Updates',
            'badgeColor' => 'bg-brand/20 text-brand',
            'title' => 'BPSU Announces New Academic Programs for 2024',
            'excerpt' => '   Bataan Peninsula State University (BPSU) is excited to announce the launch of several new academic programs starting in the academic year 2024. These programs are designed to meet the evolving needs of the job market and provide students with cutting-edge skills and knowledge...',
            'link' => '#',
            'likes' => 342,
            'comments' => 45
          ],
          [
            'author' => 'Sophia Rodriguez',
            'avatar' => 'https://lh3.googleusercontent.com/...your-url...',
            'date' => 'October 24, 2023',
            'category' => 'Student Life',
            'badgeColor' => 'bg-accent-green/20 text-accent-green',
            'title' => 'My Experience at the BPSU Innovation Fair',
            'excerpt' => ' I had an amazing time at the annual BPSU Innovation Fair! It was inspiring to see so many creative projects from fellow students. The energy was electric, and I learned so much. Highly recommend everyone to participate next year! #BPSUPride #Innovation',
            'link' => '#',
            'likes' => 198,
            'comments' => 21
          ],
          [
            'author' => 'Computer Science Society',
            'avatar' => 'https://lh3.googleusercontent.com/...your-url...',
            'date' => 'October 22, 2023',
            'category' => 'Organizations',
            'badgeColor' => 'bg-accent-blue/20 text-accent-blue',
            'title' => 'Upcoming Workshop: Intro to Web Development',
            'excerpt' => "Join the Computer Science Society for a hands-on web development workshop this Friday! We'll cover the basics of HTML, CSS, and JavaScript. No prior experience needed. Limited slots available, so sign up now!",
            'link' => '#',
            'likes' => 156,
            'comments' => 33
          ],
          
        ];

        foreach ($posts as $post) {
          extract($post); 
          include __DIR__ . '/partials/post-card.php';
        }
        ?>

        </div>
        
        <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-24 order-1 lg:order-2">
          <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
            <h3 class="text-lg font-bold mb-4 text-text-primary">Trending Topics</h3>
            <div class="space-y-3">
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#BPSUNewPrograms</a>
                <p class="text-sm text-text-secondary">1,204 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#InnovationFair2023</a>
                <p class="text-sm text-text-secondary">876 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#CSSWorkshop</a>
                <p class="text-sm text-text-secondary">451 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#StudentLife</a>
                <p class="text-sm text-text-secondary">2.3k Posts</p>
              </div>
            </div>
          </div>
        </aside>

      </div>
    </main>

  </div>
