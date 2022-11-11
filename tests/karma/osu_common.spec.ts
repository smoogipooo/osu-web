// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

describe('osu_common', () => {
  describe('locale file loaded in test runner', () => {
    it('should be loaded', () => {
      expect(window.Lang.has('common.confirmation')).toBe(true);
    });
  });

  describe('presence', () => {
    it('check for non empty string', () => {
      expect(osu.presence('test')).toBe('test');
    });

    it('check for empty string', () => {
      expect(osu.presence('')).toBe(null);
    });

    it('check for null', () => {
      expect(osu.presence(null)).toBe(null);
    });

    it('check for undefined', () => {
      expect(osu.presence()).toBe(null);
    });
  });

  describe('present', () => {
    it('check for non empty string', () => {
      expect(osu.present('test')).toBe(true);
    });

    it('check for empty string', () => {
      expect(osu.present('')).toBe(false);
    });

    it('check for null', () => {
      expect(osu.present(null)).toBe(false);
    });

    it('check for undefined', () => {
      expect(osu.present()).toBe(false);
    });
  });

  describe('trans', () => {
    it('returns the translated key', () => {
      expect(osu.trans('common.confirmation')).toBe('Are you sure?');
    });

    it('returns the untranslated key for missing translation', () => {
      expect(osu.trans('common.this_is_not_existed')).toBe('common.this_is_not_existed');
    });
  });

  describe('transArray', () => {
    it('should empty string for empty array', () => {
      expect(osu.transArray([])).toBe('');
    });

    it('should return correct translation for single item array', () => {
      expect(osu.transArray(['Me'])).toBe('Me');
    });

    it('should return correct translation for two items array', () => {
      expect(osu.transArray(['Me', 'My Self'])).toBe('Me and My Self');
    });

    it('should return correct translation for three items array', () => {
      expect(osu.transArray(['Me', 'My Self', 'I'])).toBe('Me, My Self, and I');
    });
  });

  describe('transExists', () => {
    it('check if translation exists', () => {
      expect(osu.transExists('common.confirmation')).toBe(true);
    });

    it('check if translation does not exist', () => {
      expect(osu.transExists('common.this_is_not_existed')).toBe(false);
    });
  });
});
