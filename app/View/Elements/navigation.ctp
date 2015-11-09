<div id="sidebar-left" class="col-lg-2 col-sm-1">
	<div class="nav-collapse sidebar-nav collapse navbar-collapse bs-navbar-collapse">
		<ul class="nav nav-tabs nav-stacked main-menu">
<!-- dashboard -->
			<li class="<?php echo $this->here==$this->webroot.'blogs/dashboard'?'active':'' ?>">
				<a href="<?php echo $this->webroot?>blogs/dashboard" class="title_link" >
					<i class="icon-dashboard"></i>
					<?php echo __('Dashboard'); ?>&nbsp;
				</a>
			</li>
<!-- keyword -->
			<li class="<?php echo $this->here==$this->webroot.'keywords'?'active':'' ?>">
				<a href="<?php echo $this->webroot?>keywords" class="title_link" >
					<i class="icon-link"></i>
					<?php echo __('Keyword List'); ?>
				</a>
			</li>
<!-- post -->
			<li>
				<a href="javascript:void(0)" class="dropmenu title_link">
					<i class="icon-file"></i>
					<?php echo __('Post'); ?>
					<span class="label"></span>
				</a>
				<ul>
					<!-- post -->
					<li class="<?php echo $this->here==$this->webroot.'posts'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>posts" class="title_link" >
							<i class="icon-edit"></i>
							<?php echo __('Post List'); ?>
						</a>
					</li>
					<!-- post no link -->
					<li class="<?php echo $this->here==$this->webroot.'posts/no_keyword'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>posts/no_keyword" class="title_link" >
							<i class="icon-edit"></i>
							<?php echo __('Post No Keyword List'); ?>
						</a>
					</li>
					<!-- post link count -->
					<li class="<?php echo $this->here==$this->webroot.'keywords/company'?'active':'' ?>">
						<a class="submenu" href="<?php echo $this->webroot?>keywords/company" class="title_link" >
							<i class="icon-eye-open"></i>
							<?php echo __('Company Url Post Count'); ?>
						</a>
					</li>
				</ul>
			</li>
<!-- blog -->
			<li>
				<a href="javascript:void(0)" class="dropmenu title_link">
					<i class="icon-book"></i>
					<?php echo __('Blog'); ?>
					<span class="label"></span>
				</a>
				<ul>
					<!-- blog -->
					<li class="<?php echo $this->here==$this->webroot.'blogs'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>blogs" class="title_link" >
							<i class="icon-list"></i>
							<?php echo __('Blog List'); ?>
							<span class="label label-info" id="count_client_keyword"></span>
						</a>
					</li>
					<!-- category -->
					<li class="<?php echo $this->here==$this->webroot.'categories'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>categories" class="title_link">
							<i class="icon-briefcase"></i>
							<?php echo __('Category List'); ?>
						</a>
					</li>
					<!-- design -->
					<li class="<?php echo $this->here==$this->webroot.'designs'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>designs" class="title_link" >
							<i class="icon-picture"></i>
							<?php echo __('Design List'); ?>
						</a>
					</li>
					<!-- navigation -->
					<li class="<?php echo $this->here==$this->webroot.'blog_navs'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>blog_navs" class="title_link" >
							<i class="icon-road"></i>
							<?php echo __('Blog Navigation'); ?>
						</a>
					</li>
				</ul>
			</li>
<!-- option blog & post -->
			<li>
				<a href="javascript:void(0)" class="dropmenu title_link">
					<i class="icon-flag"></i>
					<?php echo __('Option'); ?>
					<span class="label"></span>
				</a>
				<ul>
					<!-- genre -->
					<li class="<?php echo $this->here==$this->webroot.'genres'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>genres" class="title_link" >
							<i class="icon-screenshot"></i>
							<?php echo __('Genre'); ?>
						</a>
					</li>
					<!-- menu -->
					<li class="<?php echo $this->here==$this->webroot.'menus'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>menus" class="title_link" >
							<i class="icon-th-large"></i>
							<?php echo __('Menu'); ?>
						</a>
					</li>
					<!-- arbitrary -->
					<li class="<?php echo $this->here==$this->webroot.'arbitraries'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>arbitraries" class="title_link" >
							<i class="icon-random"></i>
							<?php echo __('Arbitrary'); ?>
						</a>
					</li>
					<!-- outlink list -->
					<li class="<?php echo $this->here==$this->webroot.'outlinks'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>outlinks" class="title_link" >
							<i class="icon-random"></i>
							<?php echo __('Outlink List'); ?>
						</a>
					</li>
					<!-- image list -->
					<li class="<?php echo $this->here==$this->webroot.'images'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>images" class="title_link" >
							<i class="icon-random"></i>
							<?php echo __('Image List'); ?>
						</a>
					</li>
					<!-- kotei list -->
					<li class="<?php echo $this->here==$this->webroot.'kotei_lists'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>kotei_lists" class="title_link" >
							<i class="icon-warning-sign"></i>
							<?php echo __('Kotei Keyword'); ?>
						</a>
					</li>
				</ul>
			</li>
<!-- Link check tool -->
			<li>
				<a href="javascript:void(0)" class="dropmenu title_link">
					<i class="icon-check"></i>
					<?php echo __('Link Check Tools'); ?>
					<span class="label"></span>
				</a>
				<ul>
					<!-- link check -->
					<li class="<?php echo $this->here==$this->webroot.'links'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>links" class="title_link" >
							<i class="icon-list"></i>
							<?php echo __('Link List'); ?>
						</a>
					</li>
					<!-- Link data -->
					<li class="<?php echo $this->here==$this->webroot.'link_contents'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>link_contents" class="title_link" >
							<i class="icon-search"></i>
							<?php echo __('Link Data'); ?>
						</a>
					</li>
					<!-- link resutl -->
					<li class="<?php echo $this->here==$this->webroot.'link_contents/result'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>link_contents/result" class="title_link" >
							<i class="icon-th"></i>
							<?php echo __('Link Result'); ?>
						</a>
					</li>
					<!-- link setting -->
				</ul>
			</li>
<!-- report data -->
			<li>
				<a href="javascript:void(0)" class="dropmenu title_link">
					<i class="icon-folder-close"></i>
					<?php echo __('Report'); ?>
					<span class="label"></span>
				</a>
				<ul>
					<!-- backlink report -->
					<li class="<?php echo $this->here==$this->webroot.'keywords/report'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>keywords/report" class="title_link" >
							<i class="icon-folder-open"></i>
							<?php echo __('Backlink Report'); ?>
						</a>
					</li>
				</ul>
			</li>

			<li>&npsp;</li>
<!-- system -->
			<li>
				<a href="javascript:void(0)" class="dropmenu title_link">
					<i class="icon-cog"></i>
					<?php echo __('System'); ?>
					<span class="label"></span>
				</a>
				<ul>
					<!-- Setting List -->
					<li class="<?php echo $this->here==$this->webroot.'settings'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>settings" class="title_link" >
							<i class="icon-cog"></i>
							<?php echo __('Setting List'); ?>
						</a>
					</li>
					<!-- user password -->
					<li class="<?php echo $this->here==$this->webroot.'users/edit'?'active':'' ?>">
						<a href="<?php echo $this->webroot .'users/edit/' .$this->Session->read('Auth.User.user.id'); ?>" class="title_link" >
							<i class="icon-asterisk"></i>
							<?php echo __('User Info'); ?>
						</a>
					</li>
					<!-- logs -->
					<li class="<?php echo $this->here==$this->webroot.'logs'?'active':'' ?>">
						<a href="<?php echo $this->webroot?>logs" class="title_link" >
							<i class="icon-asterisk"></i>
							<?php echo __('Logs'); ?>
						</a>
					</li>
				</ul>
			</li>
<!-- logout -->
			<li>
				<a href="<?php echo $this->webroot?>users/logout" class="title_link <?php echo $this->here==$this->webroot.'users/logout'?'active':'' ?>" ><i class="icon-lock"></i><?php echo __('Log Out'); ?></a>
			</li>
		</ul>
	</div>
</div>