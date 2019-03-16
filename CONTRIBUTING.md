Contributing
-------------------

1. File an issue to notify the maintainers about what you're working on.
2. Fork the repo, develop and test your code changes, add docs.
3. Make sure that your commit messages clearly describe the changes.
4. Send a pull request.

File an Issue
-------------------

Use the issue tracker to start the discussion. It is possible that someone
else is already working on your idea, your approach is not quite right, or that
the functionality exists already. The ticket you file in the issue tracker will
be used to hash that all out.

Keep in mind that the maintainers get final say on whether new features will be
integrated into the project.

Style Guides
-------------------
1. Source code files and documentation must be written in UTF-8 with Unix (LF) end-of-line.
2. Code should be compatible with current versions of PHP 7.1, 7.2 and 7.3.
3. Follow the official[WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/).
4. Fully test your code with [WordPress debugging enabled](https://codex.wordpress.org/WP_DEBUG) in wp-config.php:

    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true ); // Optional but can be helpful.
    define( 'WP_DEBUG_DISPLAY', false );
    
5. Test your code using the WordPress [Theme Check](https://en-ca.wordpress.org/plugins/theme-check) plugin. Ensure that there are no errors or warnings at all.
6. Look at the existing style and adhere accordingly.
7. Include [useful comments in your code](https://wpmayor.com/wordpress-commenting/).

Fork the Repository
-------------------

Be sure to do the relevant tests before making the pull request. The
documentation will be updated automatically when we merge to `v4.0`,
but you should also build the documentation yourself and make sure it is
readable.

Make a Pull Request
---------------------

Once you have made all your changes, tests, and updated the documentation,
make a pull request to move everything back into the main branch of the
`repository`. Be sure to reference the original issue in the pull request.
Expect some back-and-forth with regards to style and compliance of these
rules.

Versioning
---------------------
We use [SemVer](http://semver.org/) for versioning. 
