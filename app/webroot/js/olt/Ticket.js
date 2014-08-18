/**
 * Ticket class
 * @desc
 * @param category
 * @param issuedBy
 * @param reissuable If true, lock cannot be overridden by the same method that locked it
 * @returns {Ticket}
 * @constructor
 */


Ticket = function (category, issuedBy, reissuable) {
	//properties
	this.id = Date.now().toString();
	this.category = category;
	this.resolved = false;
	this.issuingMethod = issuedBy;
	this.reissuable = reissuable === true;
	this.data = {};

	//methods
	this.resolve = function () { return this.resolved = true;};
	return this;
};