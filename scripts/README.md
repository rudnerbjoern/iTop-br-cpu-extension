# Prepare a release

Set up the local schemas as described in [the test instructions](../tests/README.md),
then run from the repository root:

```sh
php scripts/prepare-release.php 3.2.3
```

This updates the extension manifest version, module registration version, and
manifest release date together, then runs `tests/run.php`. The default date uses
Europe/Berlin. Supply a date explicitly when needed:

```sh
php scripts/prepare-release.php 3.2.3 2026-11-06
```

The version must be newer than the existing version and use `X.Y.Z` format.
The current manifest and module versions must match. All inputs and both file
contents are checked before writing. A write failure triggers an attempt to
restore both originals; this is not a transaction across filesystem failures.
Existing formatting outside the three metadata values is preserved.

If tests fail, the command exits unsuccessfully and retains the version edits
for inspection. Resolve failures before publishing. The script does not stage,
commit, push, tag, or publish anything.

Review the diff, commit on a task branch, and merge a PR into `main`. Then start
the `Release` GitHub Actions workflow on `main` to publish the tag and ZIP.
