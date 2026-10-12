Bootstrap5 custom theme, from Bootstrap SASS (bootstrap_sass) Starter Kit.
Bootstrap5 Drupal theme 5.0.2 (https://drupal.org/project/bootstrap) is required. Install it as usual or composer will install it automatically.

Development is going on ddev environment drupal11-bs5.

For "use-as-is" install:
Under 'repositories' in composer.json add:
~~~
        {
            "type": "vcs",
            "url": "https://github.com/svetlio/custom_bs5"
        }
~~~

then install:
`composer require svetlio/custom_bs5`

For own development usage:

Detach the theme from composer or just download as a package.
`./scripts/rename_theme.sh`
- rename theme directory to new_name
- make the scripts executable: `chmod +x scripts/*`
- run the script from theme's directory `cd web/themes/custom/new_name && ./scripts/rename_theme.sh`
- enter a new theme machine_name when prompted.
- enable the new theme in the theme settings page.

`npm install` - one time install.

Compile sass changes:
`sass --watch ./sass/style.scss ./css/style.css`
